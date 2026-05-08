"use strict";function _typeof(e){return(_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){
return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e
})(e)}function ownKeys(t,e){var r,o=Object.keys(t);return Object.getOwnPropertySymbols&&(r=Object.getOwnPropertySymbols(t),e&&(
r=r.filter(function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable})),o.push.apply(o,r)),o}function _objectSpread(t){
for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?ownKeys(Object(r),!0).forEach(function(e){
_defineProperty(t,e,r[e])}):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)
):ownKeys(Object(r)).forEach(function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))})}return t}
function _defineProperty(e,t,r){return(t=_toPropertyKey(t))in e?Object.defineProperty(e,t,{value:r,enumerable:!0,
configurable:!0,writable:!0}):e[t]=r,e}function _toPropertyKey(e){e=_toPrimitive(e,"string");return"symbol"===_typeof(e
)?e:String(e)}function _toPrimitive(e,t){if("object"!==_typeof(e)||null===e)return e;var r=e[Symbol.toPrimitive];if(void 0===r
)return("string"===t?String:Number)(e);r=r.call(e,t||"default");if("object"!==_typeof(r))return r;throw new TypeError(
"@@toPrimitive must return a primitive value.")}!function o(n,i,c){function a(t,e){if(!i[t]){if(!n[t]){
var r="function"==typeof require&&require;if(!e&&r)return r(t,!0);if(u)return u(t,!0);throw(e=new Error(
"Cannot find module '"+t+"'")).code="MODULE_NOT_FOUND",e}r=i[t]={exports:{}},n[t][0].call(r.exports,function(e){return a(n[t][1
][e]||e)},r,r.exports,o,n,i,c)}return i[t].exports}for(var u="function"==typeof require&&require,e=0;e<c.length;e++)a(c[e]);
return a}({1:[function(e,t,r){t.exports={init:function(){var e;n.Debug.trace("DDC.Subscribe.init"),n.Utils.queryAll(
"form[data-subscribe]").forEach(function(e){return e.addEventListener("submit",a)}),!(o=n.Config.get(["subscribe"]))||(
o=_objectSpread(_objectSpread({},c),o)).cookie&&n.Cookie.get(o.cookie.name)||o.api&&o.api.url&&(e=1<n.Page.getPageViewCount(
)?o.show.waitSecondary:o.show.wait,window.setTimeout(u,e),o.show.selector&&n.Intersection.observe(o.show.selector,u,{
screens:o.show.screens,unobserve:!0}))}};var o,n={Analytics:window.DDC.Analytics,Api:window.DDC.Api,Config:window.DDC.Config,
Cookie:window.DDC.Cookie,Debug:window.DDC.Debug,Intersection:window.DDC.Intersection,Modal:window.DDC.Modal,
Page:window.DDC.Page,Utils:window.DDC.Utils},i={setup:!1,submit:!1},c={show:{wait:3e4,waitSecondary:1e4,screens:1}};function a(e
){n.Debug.trace("DDC.Subscribe.submit");var t=e.currentTarget,r=(t.removeAttribute("data-form-invalid"),t.getAttribute(
"data-subscribe-require-one"));return!r||(!!t.querySelector(r)||(e.preventDefault(),e.stopPropagation(),t.setAttribute(
"data-form-invalid",!0),!1))}function u(){n.Debug.trace("DDC.Subscribe.setupModal"),n.Modal.exists()||i.setup||(i.setup=!0,
n.Api.get(o.api.url).then(s))}function s(e){var t;n.Debug.trace("DDC.Subscribe.displayModal"),e.content?((t={type:e.type}
).events=[{selector:"[data-modal-close]",type:"click",listener:l}],n.Modal.setConfig(t),n.Modal.show(e.content),t=function(e,t){
e={event:"subscribe",status:"subscribe-complete"===e?"complete":"display"};return Object.assign(e,t)}(e.type,e.formData),
n.Analytics.sendEventGTM(t),n.Utils.queryAll("[data-modal-type=subscribe] form").forEach(function(e){return e.addEventListener(
"submit",b)})):n.Modal.hide()}function l(){n.Debug.trace("DDC.Subscribe.processClose"),o.cookie.name&&!n.Cookie.get(
o.cookie.name)&&n.Cookie.set(o.cookie.name,"disabled",o.cookie.expires)}function b(e){var t;n.Debug.trace(
"DDC.Subscribe.processSubmit"),e.preventDefault(),i.submit||(i.submit=!0,t=function(e){n.Debug.trace("DDC.Subscribe.getFormData"
,e.action);for(var t={target:e,data:{}},r=0;r<e.elements.length;r++){var o=e.elements[r];
!o.name||!o.checked&&"checkbox"===o.type||(t.data[o.name]=o.value.toString())}return t}(e.currentTarget),n.Api.post(o.api.url,t
).then(s),n.Utils.queryAll("[type=submit]",e.currentTarget).forEach(function(e){return e.setAttribute("disabled",1)}))}},{}],2:[
function(e,t,r){var o,n={Subscribe:e("ddc-subscribe")};function i(){n.Subscribe.init()}window.DDC=window.DDC||{},
n.Form&&n.Form.recaptchaCallback&&(window.DDC_RECAPTCHA_CALLBACK=n.Form.recaptchaCallback),e=[],window.polyfillLoaded||e.push((
o="/bundle/js/polyfill.min.js",new Promise(function(e,t){var r=document.createElement("script");
r.onload=r.onreadystatechange=function(){r.readyState&&"loaded"!==r.readyState&&"complete"!==r.readyState||(
r.onreadystatechange=null,e())},r.onerror=function(){t("Failed to load script: "+o)},r.src=o,document.body.appendChild(r)}))),
e.length?Promise.all(e).then(i).catch(function(e){}):i()},{"ddc-subscribe":1}]},{},[2]);