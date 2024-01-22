gsap.registerPlugin(ScrollTrigger);

/** Elements can have these atrtibutes:
 * [data-reveal="T"] → T must equal any of the defined in "reveal.scss"
 * [data-delay="X"] → X is seconds before triggering the reveal animation
 * [data-distance="D"] → D is absolute unit at which reveal animation starts
 * [data-rel-distance="D"] → D is % of element height at which reveal animation starts
 * [data-cb="N"] → N equals a revealCallbacks member (these are registered anywhere else in the code)
 * [data-state="on | off"] → Reveal animation starts when set to "on" (this is automatic!)
 * [data-state="on | off"] → Reveal animation starts when set to "on" (this is automatic!)
 * 
 * All childs (deep) of an element with the "revealer" class will trigger it's animation
 * in a timeline, defined by their "delay", the moment the "revealer" triggers its animation.
 * 
 * Any element, not child (deep) of a "revealer" element, will be grouped if any parent in
 * their tree has the [data-group] attribute. These groups can later be reset or restarted.
 */

const revealCallbacks = {};
const revealGroups = {
    reset: group =>
    {
        for (const tween of revealGroups[group])
            tween.targets()[0].dataset.state = 'off';
    },
    restart: group =>
    {
        for (const tween of revealGroups[group])
            tween.restart(true);
    }
};

window.addEventListener('load', () =>
{
    const $ = jQuery;
    
    // Set up auto-reveal elements:
    $('[data-reveal$="<>"]').each(function ()
    {
        const parent = $(this);
        parent.children().each(function (i)
        {
            const delay = parseFloat(parent.data('delay')) || 0;
            const offset = parseFloat(parent.data('offset')) || 0.15;
            this.dataset.reveal = parent.data('reveal').replace('<>', '');
            this.dataset.delay = (i * offset) + delay;
            this.dataset.state = 'off';
        });
    });

    const registerTween = (tween, element) =>
    {
        const groupEl = $(element).parents('[data-group]');
        if (!groupEl.length || groupEl.length < 1) return;
        
        const group = groupEl.data('group');
        if (!revealGroups[group]) revealGroups[group] = [];
        revealGroups[group].push(tween);
    }

    // All elements inside a revealer appear following a timeline:
    $('.revealer').each(function ()
    {
        const revealer = $(this);
        let distance = this.dataset.distance;
        if (!distance)
        {
            const relDistance = this.dataset['rel-distance'] || 0.3;
            distance = window.innerHeight - (revealer.height() * relDistance) + 'px';
        }
        const tl = gsap.timeline({
            trigger: revealer,
            start: `top ${distance}`
        });
        revealer.find('[data-reveal]').each(function ()
        {
            const delay = parseFloat(this.dataset.delay) || 0;
            tl.to(revealer, {onStart: () => this.dataset.state = 'on'}, delay);
        });
    });

    // All elements outside a revealer appear based on their position:
    $('*:not(.revealer) [data-reveal]').each(function ()
    {
        const delay = parseFloat(this.dataset.delay) || 0;
        let distance = this.dataset.distance;
        if (!distance)
        {
            const relDistance = this.dataset['rel-distance'] || 0.2;
            distance = window.innerHeight - ($(this).height() * relDistance) + 'px';
        }
        const tween = gsap.to(this, {
            scrollTrigger:
            {
                trigger: this,
                start: `top ${distance}px`
            },
            delay: delay,
            onStart: () => 
            {
                this.dataset.state = 'on';
                if (this.dataset.cb) revealCallbacks[this.dataset.cb]();
            }
        });
        registerTween(tween, this);
    });
});
