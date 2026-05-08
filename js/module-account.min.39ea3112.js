"use strict";!function r(n,c,a){function l(o,e){if(!c[o]){if(!n[o]){var t="function"==typeof require&&require;if(!e&&t)return t(
o,!0);if(u)return u(o,!0);throw(e=new Error("Cannot find module '"+o+"'")).code="MODULE_NOT_FOUND",e}t=c[o]={exports:{}},n[o][0
].call(t.exports,function(e){return l(n[o][1][e]||e)},t,t.exports,r,n,c,a)}return c[o].exports}for(
var u="function"==typeof require&&require,e=0;e<a.length;e++)l(a[e]);return l}({1:[function(e,o,t){o.exports={init:function(){
var e;n.Debug.trace("DDC.Account.init"),(r=n.Config.get(["account"]))&&(r.job&&(e=document.querySelector(r.job.titleInput))&&(
e.addEventListener("change",a),a()),r.password&&window.zxcvbn&&((e=document.querySelector(r.password.selector))&&(
e.addEventListener("keyup",l),l())),r.referrer&&(e=document.querySelector(r.referrer.selector)
)&&e.value&&window.location.hash&&(e.value+=window.location.hash))}};var r,n={Config:window.DDC.Config,Debug:window.DDC.Debug},
c=[{backgroundColor:"#747474",textColor:"#747474",label:"Very weak"},{backgroundColor:"#d4186f",textColor:"#a70C5f",label:"Weak"
},{backgroundColor:"#d54227",textColor:"#b84514",label:"Average"},{backgroundColor:"#259cd8",textColor:"#0a5276",label:"Good"},{
backgroundColor:"#27baa4",textColor:"#056859",label:"Great!"}];function a(){n.Debug.trace("DDC.Account.changeJobTitle");
var e=document.querySelector(r.job.titleInput).value,o=document.querySelector(r.job.specializationInput);
r.job.titleListExclusion.includes(e)?(o.disabled="disabled",o.options[0].text="N/A",o.selectedIndex=0):(o.disabled="",o.options[
0].text="-- Select specialization --")}function l(){n.Debug.trace("DDC.Account.analyzePassword");var e=document.querySelector(
r.password.selector).value,e=function(e){n.Debug.trace("DDC.Account.getPasswordScore");var o=window.zxcvbn(e,[]);if(
e.length<6||0!==o.score)return o.score;return 0!==o.score?0:1}(e=100<e.length?e.substring(0,100):e),o=document.querySelector(
r.password.meterSelector),o=(o&&(o.style.width=25*e+"%",o.style.backgroundColor=c[e].backgroundColor),document.querySelector(
r.password.labelSelector));o&&(o.style.color=c[e].textColor,o.innerText=c[e].label)}},{}],2:[function(e,o,t){var r,n={Account:e(
"ddc-account")};function c(){n.Account.init()}window.DDC=window.DDC||{},n.Form&&n.Form.recaptchaCallback&&(
window.DDC_RECAPTCHA_CALLBACK=n.Form.recaptchaCallback),e=[],window.polyfillLoaded||e.push((r="/bundle/js/polyfill.min.js",
new Promise(function(e,o){var t=document.createElement("script");t.onload=t.onreadystatechange=function(){
t.readyState&&"loaded"!==t.readyState&&"complete"!==t.readyState||(t.onreadystatechange=null,e())},t.onerror=function(){o(
"Failed to load script: "+r)},t.src=r,document.body.appendChild(t)}))),e.length?Promise.all(e).then(c).catch(function(e){}):c()}
,{"ddc-account":1}]},{},[2]);