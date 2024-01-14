"use strict";
Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.default = _arrayWithoutHoles;
function _arrayWithoutHoles(arr) {
    if (Array.isArray(arr)) {
        for(var i = 0, arr2 = new Array(arr.length); i < arr.length; i++){
            arr2[i] = arr[i];
        }
        return arr2;
    }
}
