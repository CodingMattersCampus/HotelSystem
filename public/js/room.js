!function(r){var e={};function t(n){if(e[n])return e[n].exports;var o=e[n]={i:n,l:!1,exports:{}};return r[n].call(o.exports,o,o.exports,t),o.l=!0,o.exports}t.m=r,t.c=e,t.d=function(r,e,n){t.o(r,e)||Object.defineProperty(r,e,{enumerable:!0,get:n})},t.r=function(r){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(r,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(r,"__esModule",{value:!0})},t.t=function(r,e){if(1&e&&(r=t(r)),8&e)return r;if(4&e&&"object"==typeof r&&r&&r.__esModule)return r;var n=Object.create(null);if(t.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:r}),2&e&&"string"!=typeof r)for(var o in r)t.d(n,o,function(e){return r[e]}.bind(null,o));return n},t.n=function(r){var e=r&&r.__esModule?function(){return r.default}:function(){return r};return t.d(e,"a",e),e},t.o=function(r,e){return Object.prototype.hasOwnProperty.call(r,e)},t.p="/",t(t.s=41)}({41:function(r,e,t){r.exports=t(42)},42:function(r,e){$(document).ready(function(){$("#roomstatus").change(function(){$(this).val();"occupied"==$("#roomstatus").val()?$("#roomnumber").css("background","linear-gradient(to right,rgb(153, 1, 0),rgb(212, 0, 2))"):"cleaning"==$("#roomstatus").val()?$("#roomnumber").css("background","linear-gradient(to right,rgb(12, 160, 204),rgb(6, 121, 186))"):"available"==$("#roomstatus").val()?$("#roomnumber").css("background","linear-gradient(to right,rgb(0, 96, 21),rgb(0, 185, 48))"):"maintenance"==$("#roomstatus").val()&&$("#roomnumber").css("background","linear-gradient(to right,rgb(64, 64, 64),rgb(143, 143, 143))")})})}});