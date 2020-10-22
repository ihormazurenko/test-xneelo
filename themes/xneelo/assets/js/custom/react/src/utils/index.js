
export function strip_tags(string, symbols = 300) {
    return string.replace(/(<([^>]+)>)/gi, "").slice(0, symbols)
}
