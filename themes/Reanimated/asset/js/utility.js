// Setup global stuff that goes onto the window object.

function assert(x) {
    if (typeof x !== 'boolean') {
        throw new Error("non-boolean assertion, fix your client code");
    }

    if (x === false) {
        throw new Error("assertion failed");
    }
}

window.assert = assert;
