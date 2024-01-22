/* ——— Helper functions ——— */

/**
 * Returns a value based on screen width
 * @param initial - Default value
 * @param values - Array like [max-screen-width, value]
 */
function rspv(initial, ...values)
{
    for (const value of values)
    {
        if (window.innerWidth <= value[0])
            return value[1];
    }
    return initial;
}
