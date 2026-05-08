"use strict";!function a(n,i,o){function c(t,e){if(!i[t]){if(!n[t]){var r="function"==typeof require&&require;if(!e&&r)return r(
t,!0);if(u)return u(t,!0);throw(e=new Error("Cannot find module '"+t+"'")).code="MODULE_NOT_FOUND",e}r=i[t]={exports:{}},n[t][0
].call(r.exports,function(e){return c(n[t][1][e]||e)},r,r.exports,a,n,i,o)}return i[t].exports}for(
var u="function"==typeof require&&require,e=0;e<o.length;e++)c(o[e]);return c}({1:[function(e,t,r){t.exports={init:function(){
a.Debug.trace("DDC.Form.init"),a.Utils.queryAll("form").forEach(function(e){return e.addEventListener("submit",i)}),
a.Utils.queryAll("input[data-live-validate]").forEach(function(e){return e.addEventListener("blur",o)}),a.Utils.queryAll(
"select[data-live-validate]").forEach(function(e){return e.addEventListener("change",o)}),a.Utils.queryAll("[data-auto-submit]"
).forEach(function(e){return e.addEventListener("change",u)}),a.Utils.queryAll("[data-auto-redirect]").forEach(function(e){
return e.addEventListener("change",l)}),window.addEventListener("pageshow",n)},recaptchaCallback:function(){a.Debug.trace(
"DDC.Form.recaptchaCallback"),document.querySelector(".g-recaptcha").closest("form").submit()}};var a={Api:window.DDC.Api,
Config:window.DDC.Config,Debug:window.DDC.Debug,Utils:window.DDC.Utils};function n(){a.Debug.trace("DDC.Form.reset"),
a.Utils.queryAll("[data-submit-original]").forEach(function(e){e.value=e.getAttribute("data-submit-original"),e.removeAttribute(
"disabled")})}function i(e){a.Debug.trace("DDC.Form.submit");var t=e.currentTarget.querySelector("[data-submit]");t&&(
t.setAttribute("data-submit-original",t.value),t.value=t.getAttribute("data-submit"),t.setAttribute("disabled","1")),
window.grecaptcha&&e.currentTarget.querySelector(".g-recaptcha")&&(t=e,a.Debug.trace("DDC.Form.submitRecaptcha"),
t.preventDefault(),window.grecaptcha&&"function"==typeof window.grecaptcha.reset&&(window.grecaptcha.reset(),
window.grecaptcha.execute()))}function o(e){a.Debug.trace("DDC.Form.liveValidate");var e=e.currentTarget,t=e.closest(
"[data-live-validate-url]").getAttribute("data-live-validate-url");if(!t)throw new Error(
"Live validation requires the [data-live-validate-url] attribute specify a valid URL");e={form:e.closest("form").getAttribute(
"name")||e.closest("form").getAttribute("action"),key:e.getAttribute("name"),value:e.value};a.Api.post(t,e).then(c)}function c(e
){a.Debug.trace("DDC.Form.liveValidateResponse",e);var t=document.querySelector("[name="+e.key+"]");t&&(a.Utils.removeElement(
t.closest(".ddc-form-group").querySelector(".ddc-form-hint-error")),e.response?(t.classList.add("input-warning"),
t.insertAdjacentHTML("afterend","<span class='ddc-form-hint-error'>"+e.response+"</span>")):t.classList.remove("input-warning"))
}function u(e){a.Debug.trace("DDC.Form.autoSubmit"),e.currentTarget.closest("form").submit()}function l(e){a.Debug.trace(
"DDC.Form.autoRedirect"),window.location=e.currentTarget.value}},{}],2:[function(e,t,r){var a,n={Form:e("ddc-form")};function i(
){n.Form.init()}window.DDC=window.DDC||{},n.Form&&n.Form.recaptchaCallback&&(
window.DDC_RECAPTCHA_CALLBACK=n.Form.recaptchaCallback),e=[],window.polyfillLoaded||e.push((a="/bundle/js/polyfill.min.js",
new Promise(function(e,t){var r=document.createElement("script");r.onload=r.onreadystatechange=function(){
r.readyState&&"loaded"!==r.readyState&&"complete"!==r.readyState||(r.onreadystatechange=null,e())},r.onerror=function(){t(
"Failed to load script: "+a)},r.src=a,document.body.appendChild(r)}))),e.length?Promise.all(e).then(i).catch(function(e){}):i()}
,{"ddc-form":1}]},{},[2]);