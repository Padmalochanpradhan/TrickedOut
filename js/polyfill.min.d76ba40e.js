String.prototype.padStart||(String.prototype.padStart=function(t,e){return t>>=0,e=String(void 0!==e?e:" "),
this.length>=t?String(this):((t-=this.length)>e.length&&(e+=e.repeat(t/e.length)),e.slice(0,t)+String(this))}),
String.prototype.includes||(String.prototype.includes=function(t,e){return!((e="number"!=typeof e?0:e)+t.length>this.length
)&&-1!==this.indexOf(t,e)}),String.prototype.startsWith||(String.prototype.startsWith=function(t,e){return this.substring(
!e||e<0?0:+e,t.length)===t}),String.prototype.endsWith||(String.prototype.endsWith=function(t,e){return(
void 0===e||e>this.length)&&(e=this.length),this.substring(e-t.length,e)===t}),Array.prototype.filter||(
Array.prototype.filter=function(t,e){"use strict";if("Function"!=typeof t&&"function"!=typeof t||!this)throw new TypeError;
var n=this.length>>>0,r=new Array(n),o=this,i=0,s=-1;if(void 0===e)for(;++s!=n;)s in this&&t(o[s],s,o)&&(r[i++]=o[s]);else for(
;++s!=n;)s in this&&t.call(e,o[s],s,o)&&(r[i++]=o[s]);return r.length=i,r}),Array.prototype.includes||(
Array.prototype.includes=function(t,e){if(null==this)throw new TypeError('"this" is null or not defined');var n=Object(this),
r=n.length>>>0;if(0!=r)for(var o,i,e=0|e,s=Math.max(0<=e?e:r-Math.abs(e),0);s<r;){if((o=n[s])===(i=t
)||"number"==typeof o&&"number"==typeof i&&isNaN(o)&&isNaN(i))return!0;s++}return!1}),Array.prototype.find||(
Array.prototype.find=function(t){if(null==this)throw new TypeError('"this" is null or not defined');var e=Object(this),
n=e.length>>>0;if("function"!=typeof t)throw new TypeError("predicate must be a function");for(var r=arguments[1],o=0;o<n;){
var i=e[o];if(t.call(r,i,o,e))return i;o++}}),Element.prototype.matches||(
Element.prototype.matches=Element.prototype.matchesSelector||Element.prototype.mozMatchesSelector||Element.prototype.msMatchesSelector||Element.prototype.oMatchesSelector||Element.prototype.webkitMatchesSelector||function(
t){for(var e=(this.document||this.ownerDocument).querySelectorAll(t),n=e.length;0<=--n&&e.item(n)!==this;);return-1<n}),
Element.prototype.closest||(Element.prototype.closest=function(t){var e=this;do{if(e.matches(t))return e}while(null!==(
e=e.parentElement||e.parentNode)&&1===e.nodeType);return null}),Number.isNaN=Number.isNaN||function(t){return t!=t},
"function"!=typeof Object.assign&&Object.defineProperty(Object,"assign",{value:function(t,e){"use strict";if(null==t
)throw new TypeError("Cannot convert undefined or null to object");for(var n=Object(t),r=1;r<arguments.length;r++){
var o=arguments[r];if(null!=o)for(var i in o)Object.prototype.hasOwnProperty.call(o,i)&&(n[i]=o[i])}return n},writable:!0,
configurable:!0}),"function"!=typeof window.CustomEvent&&(window.CustomEvent=function(t,e){e=e||{bubbles:!1,cancelable:!1,
detail:null};var n=document.createEvent("CustomEvent");return n.initCustomEvent(t,e.bubbles,e.cancelable,e.detail),n}),
!window.navigator||"sendBeacon"in window.navigator||(window.navigator.sendBeacon=function(t,e){try{
var n="XMLHttpRequest"in window?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTP");n.open("POST",t,!0),
n.withCredentials=!0,n.setRequestHeader("Accept","*/*"),"string"==typeof e&&(n.setRequestHeader("Content-Type",
"text/plain;charset=UTF-8"),n.responseType="text/plain"),n.send(e)}catch(t){}return!0}),
window.requestAnimationFrame=window.requestAnimationFrame||window.webkitRequestAnimationFrame||function(t){window.setTimeout(t,
50)},window.polyfillLoaded=1;