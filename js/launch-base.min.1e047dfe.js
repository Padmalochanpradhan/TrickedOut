"use strict";function _toConsumableArray(e){return _arrayWithoutHoles(e)||_iterableToArray(e)||_unsupportedIterableToArray(e
)||_nonIterableSpread()}function _nonIterableSpread(){throw new TypeError(
"Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
)}function _iterableToArray(e){if("undefined"!=typeof Symbol&&null!=e[Symbol.iterator]||null!=e["@@iterator"])return Array.from(
e)}function _arrayWithoutHoles(e){if(Array.isArray(e))return _arrayLikeToArray(e)}function ownKeys(t,e){var n,r=Object.keys(t);
return Object.getOwnPropertySymbols&&(n=Object.getOwnPropertySymbols(t),e&&(n=n.filter(function(e){
return Object.getOwnPropertyDescriptor(t,e).enumerable})),r.push.apply(r,n)),r}function _objectSpread(t){for(
var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?ownKeys(Object(n),!0).forEach(function(e){
_defineProperty(t,e,n[e])}):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)
):ownKeys(Object(n)).forEach(function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))})}return t}
function _defineProperty(e,t,n){return(t=_toPropertyKey(t))in e?Object.defineProperty(e,t,{value:n,enumerable:!0,
configurable:!0,writable:!0}):e[t]=n,e}function _toPropertyKey(e){e=_toPrimitive(e,"string");return"symbol"===_typeof(e
)?e:String(e)}function _toPrimitive(e,t){if("object"!==_typeof(e)||null===e)return e;var n=e[Symbol.toPrimitive];if(void 0===n
)return("string"===t?String:Number)(e);n=n.call(e,t||"default");if("object"!==_typeof(n))return n;throw new TypeError(
"@@toPrimitive must return a primitive value.")}function _typeof(e){return(
_typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){
return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}
function _slicedToArray(e,t){return _arrayWithHoles(e)||_iterableToArrayLimit(e,t)||_unsupportedIterableToArray(e,t
)||_nonIterableRest()}function _nonIterableRest(){throw new TypeError(
"Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."
)}function _unsupportedIterableToArray(e,t){var n;if(e)return"string"==typeof e?_arrayLikeToArray(e,t):"Map"===(n="Object"===(
n=Object.prototype.toString.call(e).slice(8,-1))&&e.constructor?e.constructor.name:n)||"Set"===n?Array.from(e
):"Arguments"===n||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)?_arrayLikeToArray(e,t):void 0}function _arrayLikeToArray(e
,t){(null==t||t>e.length)&&(t=e.length);for(var n=0,r=new Array(t);n<t;n++)r[n]=e[n];return r}function _iterableToArrayLimit(e,t
){var n=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=n){var r,i,o,a,s=[],c=!0,u=!1;try{
if(o=(n=n.call(e)).next,0===t){if(Object(n)!==n)return;c=!1}else for(;!(c=(r=o.call(n)).done)&&(s.push(r.value),s.length!==t
);c=!0);}catch(e){u=!0,i=e}finally{try{if(!c&&null!=n.return&&(a=n.return(),Object(a)!==a))return}finally{if(u)throw i}}return s
}}function _arrayWithHoles(e){if(Array.isArray(e))return e}!function r(i,o,a){function s(t,e){if(!o[t]){if(!i[t]){
var n="function"==typeof require&&require;if(!e&&n)return n(t,!0);if(c)return c(t,!0);throw(e=new Error(
"Cannot find module '"+t+"'")).code="MODULE_NOT_FOUND",e}n=o[t]={exports:{}},i[t][0].call(n.exports,function(e){return s(i[t][1
][e]||e)},n,n.exports,r,i,o,a)}return o[t].exports}for(var c="function"==typeof require&&require,e=0;e<a.length;e++)s(a[e]);
return s}({1:[function(e,t,n){t.exports={init:function(){r.Debug.trace("DDC.Accordion.init"),r.Utils.queryAll(".ddc-accordion"
).forEach(function(e){return e.addEventListener("click",i)})}};var r={Debug:e("./debug"),Utils:e("./utils")};function i(e){
r.Debug.trace("DDC.Accordion.toggleDisplay");var t,n=e.target.closest("[aria-controls]");n&&(e.preventDefault(),
e="true"!==n.getAttribute("aria-expanded"),n=n,e=e,r.Debug.trace("DDC.Accordion.toggleAccordion",e),t=n.getAttribute(
"aria-controls"),n.setAttribute("aria-expanded",e.toString()),n.classList.toggle("is-active",e),document.getElementById(t
).classList.toggle("is-active",e))}},{"./debug":13,"./utils":33}],2:[function(e,t,n){t.exports={process:function(e){
r.Debug.trace("DDC.Ads.Aim.process",e),e&&e.dgid&&r.Api.post("/api/log/aim/",e)}};var r={Api:e("../api"),Debug:e("../debug")}},{
"../api":10,"../debug":13}],3:[function(e,t,n){t.exports={buildAdHtml:function(e){r.Debug.trace("DDC.Ads.Builder.buildAdHtml",
e.id,e.type);var t=function(e){r.Debug.trace("DDC.Ads.Builder.buildCSSClassList",e.id,e.type);var t=[];t.push("display-ad"),
t.push("display-ad-injection"),t.push("display-ad-"+f(e.type)),e.lazy&&t.push("display-ad-lazy");e.width&&e.height&&(t.push(
"display-ad-"+e.width),t.push("display-ad-"+e.width+"x"+e.height));e.format&&t.push("display-ad-"+f(e.format));return t}(e);if(
s(e))return i(e,t);if(c(e))return e.data.code=e.id,function(e,t){r.Debug.trace("DDC.Ads.Builder.buildDfpAdHtml",e.id,e.data);
var n=[];return n.push("<div id='"+e.data.code+"' class='"+t.join(" ")+"'></div>"),n.join("\n")}(e,t);if(u(e)
)return e.data.adid=e.id,function(e,t){r.Debug.trace("DDC.Ads.Builder.buildEhsAdHtml",e.id);var n=[];return n.push(
"<div id='"+e.data.adid+"' class='"+t.join(" ")+"'"),n.push(
"style='display: block; width: "+e.width+"px; height: "+e.height+"px;'"),n.push("></div>"),n.join("\n")}(e,t);if(d(e)
)return e.data.code=e.id,function(e,t){r.Debug.trace("DDC.Ads.Builder.buildPrebidAdHtml",e.id,e.data);var n=[];return n.push(
"<div id='"+e.data.code+"' class='"+t.join(" ")+"'></div>"),n.join("\n")}(e,t);if(l(e))return function(e,t){
return r.Debug.trace("DDC.Ads.Builder.buildLockerdomeAdHtml",e.id),i(e,t)}(e,t);if(g(e))return function(e,t){
return r.Debug.trace("DDC.Ads.Builder.buildTapNativeAdHtml",e.id),i(e,t)}(e,t);return function(e,t){r.Debug.trace(
"DDC.Ads.Builder.buildAdSenseAdHtml",e.id);var n=[];n.push("<ins id='"+e.id+"' class='"+t.join(" ")+"'"),
e.width&&e.height?n.push("style='display: block; width: "+e.width+"px; height: "+e.height+"px;'"):n.push(
"style='display: block;'");n.push("data-ad-client='"+e.client+"'"),n.push("data-ad-channel='"+e.channel+"'"),n.push(
"data-ad-type='"+e.type+"'"),e.format&&n.push("data-ad-format='"+e.format+"'");return n.push("data-color-border='f3f3f3'"),
n.push("data-color-bg='f3f3f3'"),n.push("data-color-link='0000ff'"),n.push("data-color-text='000000'"),n.push(
"data-color-url='008000'"),n.push("data-analytics-domain-name='drugs.com'></ins>"),n.join("\n")}(e,t)},loadAd:function(e){
r.Debug.trace("DDC.Ads.Builder.loadAd",e.id),s(e)?e.data.script?r.Load.addScriptTag(e.data.script):o(e):(c(e)?o:u(e)?function(e
){r.Debug.trace("DDC.Ads.Builder.loadEhsAd",e.id);var n=["url="+encodeURIComponent(window.location.href)];Object.keys(e.data
).forEach(function(t){Array.isArray(t)?Object.keys(t).forEach(function(e){n.push(t+"="+t[e])}):n.push(t+"="+e.data[t])});
r.Load.addScriptTag("//ads.ehealthcaresolutions.com/a/?"+n.join("&"))}:d(e)?function(e){r.Debug.trace(
"DDC.Ads.Builder.loadPrebidAd",e.id),e=a(e),r.Ads.Display.loadAd(e.data)}:l(e)?function(e){r.Debug.trace(
"DDC.Ads.Builder.loadLockerdomeAd",e.id,e.data),window.ldAdInit=window.ldAdInit||[],window.ldAdInit.push({id:e.data.id,size:[0,0
],slot:parseInt(e.data.slot)});r.Load.addScriptTag("//cdn2.lockerdomecdn.com/_js/ajs.js",{attributes:[{name:"id",value:"ld-ajs"}
]})}:g(e)?function(e){r.Debug.trace("DDC.Ads.Builder.loadTapNativeAd",e.id,e.data);e=["aid="+e.data.id.replace("adx_native_ad_",
""),"url="+encodeURIComponent(window.location.href),"r="+1e16*Math.random()];r.Load.addScriptTag(
"//content.tapnative.com/tn/?"+e.join("&"))}:function(e){r.Debug.trace("DDC.Ads.Builder.loadAdSenseAd",e.id),
r.Load.addScriptTag("//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js",{enforceUnique:!0}),document.getElementById(e.id
).classList.add("adsbygoogle"),(window.adsbygoogle=window.adsbygoogle||[]).push({})})(e)},isLockerdome:l,isTapNative:g};var r={
Ads:{Display:e("./display")},Config:e("../config"),Debug:e("../debug"),Load:e("../load")};function i(e,t){r.Debug.trace(
"DDC.Ads.Builder.buildCustomAdHtml",e.id);var n=[];return n.push("<div id='".concat(e.id,"' class='").concat(t.join(" "),"'>")),
e.data.html?n.push(e.data.html):e.data&&Object.entries&&(t=Object.entries(e.data).map(function(e){return e[0]+"="+e[1]}),n.push(
"<div ".concat(t.join(" "),"></div>"))),n.push("</div>"),n.join("\n")}function o(e){r.Debug.trace("DDC.Ads.Builder.loadDfpAd",
e.id,e.data),e=a(e),r.Ads.Display.loadAd(e.data)}function a(e){var t=r.Config.get(["ads","minWidth728"]),n=r.Config.get(["ads",
"minWidth970"]);return e.data.targeting=e.data.targeting||{},e.data.targeting.loading=e.lazy?"lazy":"eager",
e.data.targeting.autoposition=e.index,e.data.targeting.lazyloadscreens=e.lazy||0,
e.data.targeting.content728=window.innerWidth>=t?1:0,e.data.targeting.content970=window.innerWidth>=n?1:0,e}function s(e){
return e.type&&"custom"===e.type.toLowerCase()}function c(e){return e.type&&"dfp"===e.type.toLowerCase()}function u(e){
return e.type&&"ehs"===e.type.toLowerCase()}function d(e){return e.type&&"prebid"===e.type.toLowerCase()}function l(e){
return e.type&&"lockerdome"===e.type.toLowerCase()}function g(e){return e.type&&"tapnative"===e.type.toLowerCase()}function f(e
){return e.toLowerCase().replace(/[^a-z]+/,"-")}},{"../config":11,"../debug":13,"../load":23,"./display":4}],4:[function(e,t,n){
t.exports={init:function(){var t,n;c.Debug.trace("DDC.Ads.Display.init"),(s=c.Config.get(["ads","display"]))&&(
s.refreshEnabled=c.Ads.Refresh.setup(),s.gptSizeMapping=c.Config.get(["ads","gptSizeMapping"]),c.Debug.trace(
"DDC.Ads.Display.run"),v()&&(s.units=c.Ads.Layout.process(s.units,s.gptSizeMapping),c.Config.storeData("displayAdsRenderCount",
s.units.length),t=s.targeting,c.Debug.trace("DDC.Ads.Display.setup"),t&&(t=function(e){c.Debug.trace(
"DDC.Ads.Display.mergeUserTargeting");var t=c.Cookie.get("ddcath1");return t&&(t=t.split("."),
Array.prototype.filter&&Array.prototype.map&&(e.bh=t.filter(function(e){return e.startsWith("b")}).map(function(e){
return e.substring(1)}),e.dh=t.filter(function(e){return e.startsWith("d")}).map(function(e){return e.substring(1)}))),e}(t),
n={},Object.keys(t).forEach(function(e){Array.isArray(t[e])?n[e]=t[e].map(c.Encrypt.md5):0===parseInt(t[e])||1===parseInt(t[e]
)?n[e]=t[e]:n[e]=c.Encrypt.md5(t[e])}),window.googletag.cmd.push(function(){Object.keys(t).forEach(function(e){
window.googletag.pubads().setTargeting(e,t[e])}),window.googletag.pubads().enableSingleRequest(),window.googletag.pubads(
).enableAsyncRendering(),window.googletag.pubads().disableInitialLoad(),window.googletag.pubads().addEventListener(
"slotRenderEnded",l),window.googletag.pubads().addEventListener("slotVisibilityChanged",g),window.googletag.pubads(
).addEventListener("impressionViewable",f),window.googletag.enableServices()}),
window.pbjs&&window.pbjs.setConfig&&window.pbjs.setConfig({ortb2:{site:{ext:{data:n}}}})),c.Debug.trace(
"DDC.Ads.Display.setupLazyLoading"),c.Intersection.hasSupport()&&s.units.length&&(r=s.units.filter(function(e){return e.lazy}),
s.units=s.units.filter(function(e){return!e.lazy}),r.forEach(function(e){c.Intersection.observe("#"+e.code,p,{screens:e.lazy,
unobserve:!0})})),b(s.units)),c.Debug.trace("DDC.Ads.Display.logPageView"),A({event:d.event.pageview}),
s.refreshEnabled&&window.setInterval(w,1e3),window.setTimeout(S,2e3))},loadAd:h};var s,c={Ads:{Layout:e("./layout"),Refresh:e(
"./refresh")},Config:e("../config"),Cookie:e("../cookie"),Debug:e("../debug"),Encrypt:e("../encrypt"),Intersection:e(
"../intersection")},r=[],i=0,o={resize:0},u={prebid:[],standard:[]},a={},d={timer:0,ads:[],event:{pageview:"pageview",
load:"load",impression:"impression"}};function l(e){var t;t=e,c.Debug.trace("DDC.Ads.Display.logAdLoad"),A({event:d.event.load,
lineItemId:t.sourceAgnosticLineItemId,creativeId:t.sourceAgnosticCreativeId,slotId:t.slot.getSlotElementId(),
adUnit:t.slot.getAdUnitPath().replace("/7146/",""),size:t.size,isEmpty:t.isEmpty}),s.refreshEnabled&&c.Ads.Refresh.recordLoad(e)
}function g(e){s.refreshEnabled&&c.Ads.Refresh.updateVisibility(e)}function f(e){var t;t=e,c.Debug.trace(
"DDC.Ads.Display.logAdImpression"),A({event:d.event.impression,slotId:t.slot.getSlotElementId(),adUnit:t.slot.getAdUnitPath(
).replace("/7146/","")}),s.refreshEnabled&&c.Ads.Refresh.recordImpression(e)}function p(t){c.Debug.trace(
"DDC.Ads.Display.handleLazyLoad",t.id),h(r.find(function(e){return e.code===t.id}))}function h(e){c.Debug.trace(
"DDC.Ads.Display.loadAd",e.code),b([e])}function b(e){c.Debug.trace("DDC.Ads.Display.loadAds",e.length),v(
)&&e.length&&window.googletag.cmd.push(function(){var a={prebid:[],standard:[]};e.forEach(function(e){var n,r,
t=s.gptSizeMapping&&e.sizeMappings.length?(t=e.sizeMappings,c.Debug.trace("DDC.Ads.Display.getSizesFromMappings",t),n=[],r=[],
t.forEach(function(e){e=e[1];Array.isArray(e[0])?e.forEach(i):e.length&&i(e)}),n):e.sizes;function i(e){var t=e.join("x");
r.includes(t)||(r.push(t),n.push(e))}e.slot=function(e,t,n,r,i){c.Debug.trace("DDC.Ads.Display.defineAdSlot",e,t,n,r,i);
var o=window.googletag.defineSlot(e,t,r);if(!o)return c.Debug.trace("DDC.Ads.Display.defineAdSlot:failed",e,t,n,r),null;
s.gptSizeMapping&&n.length&&o.defineSizeMapping(function(e){c.Debug.trace("DDC.Ads.Display.defineSizeMapping",e);
var t=window.googletag.sizeMapping();return e.forEach(function(e){return t.addSize(e[0],e[1])}),t.build()}(n));
return o.addService(window.googletag.pubads()),Object.keys(i).forEach(function(e){o.setTargeting(e,i[e])}),o}(e.section,t,
e.sizeMappings,e.code,e.targeting);var o=e.prebid?"prebid":"standard";a[o].push(e.slot),u[o].push(e.slot),
window.googletag.display(e.code)}),y(a.prebid),D(a.standard)})}function D(e){c.Debug.trace("DDC.Ads.Display.loadStandardAds",
e.length),e.length&&window.googletag.pubads().refresh(e,{changeCorrelator:!1})}function y(e){var t;c.Debug.trace(
"DDC.Ads.Display.loadPrebidAds",e.length),e.length&&(t=Math.floor(Date.now()*Math.random()),a[t]={startTime:Date.now(),
responseHandled:0},window.pbjs.rp.requestBids({callback:function(e){return m(e,t,"success")},gptSlotObjects:e,data:{}}),
window.setTimeout(function(){return m(e,t,"timeout")},s.timeout+250))}function m(e,t,n){var r;a[t].responseHandled++||v()&&(
r=Date.now()-a[t].startTime,c.Debug.trace("DDC.Ads.Display.handlePrebidResponse",e.length,t,n,r),window.googletag.cmd.push(
function(){return window.googletag.pubads().refresh(e,{changeCorrelator:!1})}))}function w(){var e,
t=c.Ads.Refresh.getEligibleSlotIds();t.length&&(c.Debug.trace("DDC.Ads.Display.refreshAds",t),e=[].concat(u.prebid.filter(
function(e){return e&&t.includes(e.getSlotElementId())}),u.standard.filter(function(e){return e&&t.includes(e.getSlotElementId()
)})).map(function(e){var t=parseInt(e.getTargeting("rc"))||0;return e.setTargeting("rc",t+1),e}),window.googletag.pubads(
).refresh(e,{changeCorrelator:!1}))}function v(){c.Debug.trace("DDC.Ads.Display.initGoogleTag");try{
return window.googletag=window.googletag||{},window.googletag.cmd=window.googletag.cmd||[],window.pbjs=window.pbjs||{},
window.pbjs.rp=window.pbjs.rp||{},"function"==typeof window.googletag.cmd.push}catch(e){}}function A(e){c.Debug.trace(
"DDC.Ads.Display.addLogEvent",e.slotId),d.ads.push(e),window.clearTimeout(d.timer),d.timer=window.setTimeout(C,2e3)}function C(
){var e;c.Debug.trace("DDC.Ads.Display.sendLog",d.ads.length),window.fetch&&((e=c.Debug.getData()).ads=d.ads.slice(),e={
method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/json"},body:JSON.stringify(e)},window.fetch(
s.logUrl,e),d.ads=[])}function S(){c.Debug.trace("DDC.Ads.Display.setupResizeHandler"),s.gptSizeMapping&&(i=window.innerWidth,
window.addEventListener("resize",function(){clearTimeout(o.resize),o.resize=setTimeout(E,200)}))}function E(){c.Debug.trace(
"DDC.Ads.Display.handleViewportResize",i,window.innerWidth),i!==window.innerWidth&&(window.googletag.cmd.push(function(){y(
u.prebid),D(u.standard)}),i=window.innerWidth)}},{"../config":11,"../cookie":12,"../debug":13,"../encrypt":15,
"../intersection":21,"./layout":7,"./refresh":8}],5:[function(e,t,n){t.exports={Aim:e("./aim"),Builder:e("./builder"),Display:e(
"./display"),Injection:e("./injection"),Refresh:e("./refresh")}},{"./aim":2,"./builder":3,"./display":4,"./injection":6,
"./refresh":8}],6:[function(e,t,n){t.exports={init:function(){if(c.Debug.trace("DDC.Ads.Injection.init"),s=c.Config.get(["ads",
"injection"])){if(s.gptLazyLoad=c.Config.get(["ads","gptLazyLoad"]),c.Debug.trace("DDC.Ads.Injection.insertAds"),s.list&&(
r=document.querySelector(s.container))){c.Debug.trace("DDC.Ads.Injection.enforceConditionals");for(var e=0;e<s.list.length;e++
)s.list[e].conditional&&s.list[e].conditional.fallback&&(!function(e){if(c.Debug.trace(
"DDC.Ads.Injection.useConditionalFallback"),e.minWidth&&e.minWidth>window.innerWidth)return 1;if(
e.minHeight&&e.minHeight>window.innerHeight)return 1;return e.force}(s.list[e].conditional)?delete s.list[e].conditional:(
s.list[e]=s.list[e].conditional.fallback,e--));var t=function(o){c.Debug.trace("DDC.Ads.Injection.insertContentAds");var a=g(
s.start);return function(){c.Debug.trace("DDC.Ads.Injection.getTagOffsetData");var e,t=[];return s.insert&&(e=[].slice.call(
r.querySelectorAll(s.insert.join(","))),(e=s.maximum.tags?e.slice(0,s.maximum.tags):e).forEach(function(e){!function(e){if(
c.Debug.trace("DDC.Ads.Injection.ignore"),s.blacklist)for(var t=0;t<s.blacklist.length;t++)if(e.parentElement.closest(
s.blacklist[t]))return 1;return}(e)&&t.push({target:e,tagName:e.tagName?e.tagName.toLowerCase():"",offsetTop:f(e)})})),t}(
).forEach(function(e){var t,n,r,i;s.maximum.ads&&d.content>s.maximum.ads||o&&(o.buffer<0&&(a=0,n=(o.viewportPercent||100)/100,
o.buffer=Math.round(window.innerHeight*n)),o.minBuffer&&(o.buffer=Math.max(o.buffer,o.minBuffer)),e.offsetTop>a+o.buffer&&(
o.offsetTop=e.offsetTop,(a||o.viewportPercent<100)&&(e.target=(n=e.target,c.Debug.trace("DDC.Ads.Injection.rejig"),(
i=n.previousElementSibling)&&(r=(n=(i=n.matches("ol, ul")&&i.matches("p")?(n=i).previousElementSibling:i).matches(
"h2, h3, h4, h5, strong")?i:n).nextElementSibling)&&(i.matches("figure")&&r.nextElementSibling&&(n=r.nextElementSibling),
i.previousElementSibling&&i.previousElementSibling.matches("figure")&&(n=r)),n)),i=e,c.Debug.trace(
"DDC.Ads.Injection.getInsertAdOptions",i.tagName),r={},
s.options&&s.options.position&&s.options.match&&s.options.match===i.tagName&&(r.position=s.options.position),
t=r.position||u.before,d.content+=p(e.target,o,t),a=parseInt(e.offsetTop),o=l()))}),o}(l());c.Debug.trace(
"DDC.Ads.Injection.insertBottomAd"),t&&s.last&&0===d.content&&0===d.native&&g(s.start)+s.last.buffer<f(r)+r.clientHeight&&(
d.bottom+=p(r,t,u.append))}c.Debug.trace("DDC.Ads.Injection.setupLazyLoading"),i.length&&c.Intersection.observe(
".display-ad-lazy",h,{screens:s.lazy,unobserve:!0}),c.Debug.trace("DDC.Ads.Injection.logAnalytics",d);t={nonInteraction:1,
dimension74:(t=parseInt(c.Config.retrieveData("displayAdsRenderCount"))||0).toString(),dimension67:d.top.toString(),
dimension68:d.content.toString(),dimension69:d.bottom.toString(),dimension73:d.lazy.toString(),dimension70:b().toString(),
metric5:t,metric8:d.top,metric9:d.content,metric10:d.bottom,metric15:d.lazy,metric11:b()};c.Analytics.sendEvent("autoads",
"loaded","yes",t)}}};var s,r,c={Ads:{Builder:e("./builder")},Analytics:e("../analytics"),Config:e("../config"),Debug:e(
"../debug"),Helper:e("../helper"),Intersection:e("../intersection")},i=[],o={},u={before:"before",after:"after",
prepend:"prepend",append:"append",replace:"replace"},d={top:0,content:0,bottom:0,lazy:0,lazyLoaded:0,native:0},a=0;function l(){
var e,t;return c.Debug.trace("DDC.Ads.Injection.getNextAd"),!(t=s.list.length?s.list.shift():t)&&s.repeat&&(
t=c.Helper.Object.clone(s.repeat)).data&&t.data.targeting&&t.data.targeting.uid&&(e=t.data.targeting.uid,
t.data.targeting.uid=e.replace(/(.+)-(\d+)$/,function(e,t,n){return a=a||n,t+"-"+a++})),t?((e=t).index=b()+1,
t=c.Ads.Builder.isLockerdome(e)||c.Ads.Builder.isTapNative(e)?e.type.toLowerCase()+"-":"",e.id="display-ad-injection-"+t+e.index
,o[e.id]=e):null}function g(e){c.Debug.trace("DDC.Ads.Injection.getStartOffset",e);e=function(e){c.Debug.trace(
"DDC.Ads.Injection.getTargetFromSelectorList",e),Array.isArray(e)||(e=[e]);for(var t=0;t<e.length;t++){
var n=document.querySelector(e[t]);if(n)return n}return null}(e);return e?f(e)+e.clientHeight:0}function f(e){if(!e)return 0;
for(var t=0;t+=e.offsetTop||0,e=e.offsetParent;);return Math.round(t)}function p(e,t,n){c.Debug.trace(
"DDC.Ads.Injection.injectAd",n);var r=c.Ads.Builder.buildAdHtml(t);if(c.Debug.trace("DDC.Ads.Injection.injectHtmlNearTarget",n),
n===u.before)e.insertAdjacentHTML("beforebegin",r);else if(n===u.after)e.insertAdjacentHTML("afterend",r);else if(n===u.prepend
)e.insertAdjacentHTML("afterbegin",r);else if(n===u.append)e.insertAdjacentHTML("beforeend",r);else{if(n!==u.replace
)throw new Error("Invalid 'position' parameter: "+n);e.innerHTML=r}return t.lazy&&!s.gptLazyLoad&&c.Intersection.hasSupport()?(
n=t,c.Debug.trace("DDC.Ads.Injection.addLazyLoadAd",n.id),e=document.getElementById(n.id),n={ad:n,offset:f(e),height:Math.round(
e.offsetHeight||e.clientHeight)},i.push(n),d.lazy=i.length):c.Ads.Builder.loadAd(t),1}function h(e){c.Debug.trace(
"DDC.Ads.Injection.lazyLoadAd",e.id),o[e.id]&&(c.Ads.Builder.loadAd(o[e.id]),delete o[e.id],d.lazyLoaded++)}function b(){
return d.top+d.content+d.bottom}},{"../analytics":9,"../config":11,"../debug":13,"../helper":18,"../intersection":21,
"./builder":3}],7:[function(e,t,n){t.exports={process:function(e,t){if(a.Debug.trace("DDC.Ads.Layout.process",e.length,t),
!e.length)return[];e=function(e){return a.Debug.trace("DDC.Ads.Layout.checkAdElementExists",e.length),e.filter(function(e){
return Boolean(document.getElementById(e.code))})}(e),t||(e=function(e){return a.Debug.trace(
"DDC.Ads.Layout.checkLeaderboard970Ads",e.length),e.forEach(function(e){e.sizes=e.sizes.filter(function(e){return e[0]<970||e[0
]<window.innerWidth-30&&920<window.innerHeight})}),e}(e));return e=function(e){a.Debug.trace("DDC.Ads.Layout.checkSidebar300Ads"
,e.length);for(var t=e.length-1;0<=t;t--)(function(e){if(a.Debug.trace("DDC.Ads.Layout.isLayoutInvalid",e.code),e.layout){if(
e.layout.requiresContentHeight&&r("sidebar")>r("content"))return 1;if(e.layout.requiresSidebarFloat&&function(){
var e=window.devicePixelRatio||1;return window.innerHeight>window.innerWidth&&window.innerWidth/e<=1024}())return 1}return})(e[t
])&&c(s(e[t].code,e[t].layout.wrappingClass))&&e.splice(t,1);return e}(e=function(e){return a.Debug.trace(
"DDC.Ads.Layout.checkSidebar160Ads",e.length),e.filter(function(e){if(e.layout&&e.layout.requiredFixedPosition){e=s(e.code,
e.layout.wrappingClass);if(e&&"fixed"!==(i=e,o="position",a.Debug.trace("DDC.Ads.Layout.getCssValue",o),
i?window.getComputedStyle(i).getPropertyValue(o):null)){var t=e;if(a.Debug.trace("DDC.Ads.Layout.removeSiblingsFloat"),
t.parentNode&&t.parentNode.childNodes&&t.parentNode.childNodes.length)for(var n=0;n<t.parentNode.childNodes.length;n++){
var r=t.parentNode.childNodes[n];r.classList&&r.classList.contains("sideBoxFloatLeft")&&r.classList.remove("sideBoxFloatLeft")}
if(c(e))return!1}}var i,o;return!0})}(e))}};var a={Debug:e("../debug")};function s(e,t){a.Debug.trace(
"DDC.Ads.Layout.getAncestorByClassName",e,t);var n=document.getElementById(e);if(n)for(;n=n.parentElement;)if(
n&&n.classList&&n.classList.contains(t))return n;return null}function r(e){a.Debug.trace("DDC.Ads.Layout.getHeight",e);
e=document.getElementById(e);return e?e.clientHeight:null}function c(e){return a.Debug.trace("DDC.Ads.Layout.removeElement"),
e&&e.parentNode.removeChild(e)}},{"../debug":13}],8:[function(e,t,n){t.exports={setup:function(){return o.Debug.trace(
"DDC.Ads.Refresh.init"),!!(r=o.Config.get(["ads","refresh"]))&&(i=Date.now(),window.addEventListener("scroll",function(){
i=Date.now()}),!0)},recordLoad:function(e){var t=e.slot.getSlotElementId();return o.Debug.trace("DDC.Ads.Refresh.recordLoad",t),
!e.isEmpty&&1<e.size[1]?function(e,t){o.Debug.trace("DDC.Ads.Refresh.subscribeSlot",e,t),a[e]={lineItemId:t,whenLoaded:Date.now(
),whenViewed:0,whenFocused:0,hasFocus:!1};t=c(e);t&&(t.onmouseover=function(){a[e].hasFocus=!0},t.onmouseout=function(){a[e
].hasFocus=!1,a[e].whenFocused=Date.now()})}(t,e.lineItemId):s(t)},recordImpression:function(e){e=e.slot.getSlotElementId();
o.Debug.trace("DDC.Ads.Refresh.recordImpression",e),a[e]&&(a[e].whenViewed=Date.now())},updateVisibility:function(e){
var t=e.slot.getSlotElementId();o.Debug.trace("DDC.Ads.Refresh.updateVisibility",t),a[t]&&(a[t].viewArea=e.inViewPercentage)},
getEligibleSlotIds:function(){var t;return"function"!=typeof document.hasFocus||document.hasFocus()?(t=[],Object.keys(a
).forEach(function(e){!function(e){var t=Date.now();if(e.hasFocus)return;if(e.whenFocused&&t-e.whenFocused<r.minSinceFocus
)return;if(t-e.whenViewed<r.minSinceImpression)return;var n=e.lineItemId?r.minSinceLoadDfp:r.minSinceLoadAdx;if(
!n||t-e.whenLoaded<n)return;if(e.viewArea<r.minViewArea)return;if(t-i>r.maxInactivity)return;return 1}(a[e])||(t.push(e),s(e))})
,t):[]}};var r,i,o={Config:e("../config"),Debug:e("../debug")},a={};function s(e){o.Debug.trace(
"DDC.Ads.Refresh.unsubscribeSlot",e),delete a[e];e=c(e);e&&(e.onmouseover=null,e.onmouseout=null)}function c(e){
e=document.getElementById(e);return e?e.getElementsByTagName("iframe")[0]:null}},{"../config":11,"../debug":13}],9:[function(e,t
,n){t.exports={init:function(){i.Debug.trace("DDC.Analytics.init"),i.Utils.queryAll("[data-ga-category]").forEach(function(e){
return e.addEventListener("click",a)}),i.Utils.queryAll("[data-gtm-intersection]").forEach(function(e){
return i.Intersection.observe(e,o)}),i.Utils.queryAll("[data-gtm-click]").forEach(function(e){return e.addEventListener("click",
o)}),i.Utils.queryAll("[data-gtm-submit]").forEach(function(e){return e.addEventListener("submit",o)}),window.setTimeout(
function(){s("NoBounce","Over 30 seconds"),d({event:"GAEvent",category:"NoBounce",eventAction:"Over 30 seconds"})},3e4)},
set:function(){i.Debug.trace("DDC.Analytics.set");for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];
t.unshift("set"),u(t)},sendEvent:s,sendSocial:c,sendEventGTM:d};var i={Config:e("./config"),Debug:e("./debug"),Intersection:e(
"./intersection"),Utils:e("./utils")},r={};function o(e){i.Debug.trace("DDC.Analytics.processEvent"),(e=e.currentTarget||e
)&&e.attributes&&d(function(e){i.Debug.trace("DDC.Analytics.getAttributeData",e.length);for(var t={},n=0;n<e.length;n++){
var r=e[n];r.name.startsWith("data-gtm-")&&(r.value?t[r.name.replace("data-gtm-","")]=r.value:t.action=r.name.replace(
"data-gtm-",""))}return t}(e.attributes))}function a(e){i.Debug.trace("DDC.Analytics.recordEvent");var t,n,e=e.currentTarget,e={
category:e.getAttribute("data-ga-category"),action:e.getAttribute("data-ga-action"),label:e.getAttribute("data-ga-label")};e=e,
i.Debug.trace("DDC.Analytics.trackOnce",e),e&&e.category&&e.action&&(t=[e.category,e.action,e.label].join("-"),r[t]||(r[t]=!0,
t=e,i.Debug.trace("DDC.Analytics.track",t),e=t.label||"",n=t.value||0,"social"===t.category?c(t.action,e):(i.Config.get(["agent"
,"isMobile"])&&(t.category+="-Mobile"),s(t.category,t.action,e,n,{nonInteraction:1}),d({event:"GAEvent",category:t.category,
eventAction:t.action,eventLabel:e,eventValue:n,nonInteraction:1}))))}function s(){i.Debug.trace("DDC.Analytics.sendEvent");for(
var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];t.unshift("send","event"),u(t)}function c(){i.Debug.trace(
"DDC.Analytics.sendSocial");for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];t.unshift("send","social"),
u(t)}function u(e){i.Debug.trace("DDC.Analytics.apply",JSON.stringify(e)),"function"==typeof window.ga&&window.ga.apply(this,e)}
function d(e){i.Debug.trace("DDC.Analytics.sendEventGTM",e),window.dataLayer&&Array.isArray(window.dataLayer
)&&window.dataLayer.push(e)}},{"./config":11,"./debug":13,"./intersection":21,"./utils":33}],10:[function(e,t,n){t.exports={
get:function(e,t){return o.Debug.trace("DDC.Api.get",e),(t=t||{}).method="GET",r(e,t)},post:function(e,t,n){
return o.Debug.trace("DDC.Api.post",e),(n=n||{}).method="POST",n.body=o.Helper.Object.safeStringify(t),n.headers=n.headers||{},
n.headers["Content-Type"]="application/json",r(e,n)}};var o={Debug:e("./debug"),Helper:e("./helper")},a={};function r(e,t){if(
o.Debug.trace("DDC.Api.send",e,t),!window.fetch)return Promise.reject(new Error("Object 'window' has no method 'fetch'"));
t.credentials="same-origin",t.headers=t.headers||{},t.headers["X-Client-Date"]=(new Date).toUTCString();n=_slicedToArray((n=e
).split("?"),1)[0],r=Date.now(),a[n]={start:r,stop:0};var n,r,i={key:n,start:r};return window.fetch(e,t).then(function(e){
var t=i.key,n=i.start;if(o.Debug.trace("DDC.Api.checkStatus",t,n),!e.ok)throw c(e);if(function(e,t){e=a[e];
return t<e.start&&e.stop}(t,n))throw c(e,204,"No Content; Stale Response");return a[t].stop=Date.now(),e}).then(s)}function s(e
){return o.Debug.trace("DDC.Api.processResponse"),function(e){e=e.headers.get("content-type");return Boolean(e&&e.includes(
"application/json"))}(e)?e.json():e.text()}function c(e,t,n){t=t||e.status,n=n||e.statusText;var r=new Error(t+" ("+n+")");
return r.response=e,r.status=t,r.statusText=n,r}},{"./debug":13,"./helper":18}],11:[function(e,t,n){t.exports={site:i,
get:function(e){if(!Array.isArray(e))throw new Error("Config.get() parameter 'keys' must be an array");for(var t=i(),
n=0;n<e.length;n++){if(void 0===t[e[n]])return null;t=t[e[n]]}return t},retrieveData:function(e){r.Debug.trace(
"DDC.Config.retrieveData",e);var t=i();return t.dataStore=t.dataStore||{},void 0!==t.dataStore[e]?t.dataStore[e]:null},
storeData:function(e,t){r.Debug.trace("DDC.Config.storeData",e);var n=i();n.dataStore=n.dataStore||{},n.dataStore[e]=t}};var r={
Debug:e("./debug")};function i(){return window.SITECONFIG||{}}},{"./debug":13}],12:[function(e,t,n){t.exports={get:function(e){
o.Debug.trace("DDC.Cookie.get",e);for(var t=e+"=",n=document.cookie.split(";"),r=0;r<n.length;r++){var i=n[r].replace(/^\s+/,"")
if(0===i.indexOf(t))return i.substring(t.length,i.length)}return null},set:r,remove:function(e){r(e,"",-1)}};var o={Debug:e(
"./debug")};function r(e,t,n,r){o.Debug.trace("DDC.Cookie.set",e),n=n||0,r=r||"/",document.cookie=e+"="+t+((e=n)?((t=new Date
).setDate(t.getDate()+e),";expires="+t.toUTCString()):"")+";path="+r+";domain=drugs.com"}},{"./debug":13}],13:[function(e,t,n){
t.exports={init:function(){i=function(){try{var e=window.localStorage.getItem("DDC.Debug.options");return JSON.parse(e)}catch(e
){return""}}(),window.SITEVARS=window.SITEVARS||{},window.SITEVARS.stackTrace=window.SITEVARS.stackTrace||[],
window.SITEVARS.urlHistory=window.SITEVARS.urlHistory||[],l()?(d("DDC.Debug.init","label"),g(),c()
):s&&window.console&&window.console.log("For debugging options, refer to JS project README.")},get:c,set:u,add:function(e){g(),
e.hide&&(e.hide=i.hide.concat(e.hide));e.show&&(e.show=i.show.concat(e.show));e.mark&&(e.mark=i.mark.concat(e.mark));return u(e)
},dir:function(e,t){l()&&(t&&d("Object: "+t,"label"),window.console.log("%o",e))},history:function(e){
window.SITEVARS.urlHistory.push(e),window.SITEVARS.urlHistory.length>o.urlHistory&&window.SITEVARS.urlHistory.shift()},
trace:function(){for(var e,t=arguments.length,n=new Array(t),r=0;r<t;r++)n[r]=arguments[r];(function(e){
window.SITEVARS.stackTrace.push(e),window.SITEVARS.stackTrace.length>o.stackTrace&&window.SITEVARS.stackTrace.shift()})(n.join(
" : ")),l()&&(e=function(e){var t;if(i&&i.mark)for(t=0;t<i.mark.length;t++)if(0===e.lastIndexOf(i.mark[t],0))return 3;if(
i&&i.show)for(t=0;t<i.show.length;t++)if(0===e.lastIndexOf(i.show[t],0))return 1;return 0}(n[0]),d(function(e){for(
var t=0;t<e.length;t++)if("object"===_typeof(e[t]))try{e[t]=JSON.stringify(e[t]).replace(/"/g,"")}catch(e){}return e.join(" : ")
}(n),e))},getData:function(){r=r||Date.now();var e=window.location.pathname.split("/"),
t=window.SITECONFIG&&window.SITECONFIG.user?window.SITECONFIG.user:{userid:0,ipAddress:""};return{guid:r,request:{
section:2<e.length?e[1]:"misc",url:function(e){return[e.protocol,"//",e.host,e.pathname,e.hash].join("")}(window.location),
QueryString:function(e){if(!e||e.length<3)return{};return JSON.parse('{"'+decodeURI(e.substring(1)).replace(/"/g,'\\"').replace(
/&/g,'","').replace(/[=]/g,'":"')+'"}')}(window.location.search),hash:window.location.hash||null},user:{userId:t.userid,
ipAddress:t.ipAddress},navigator:function(){var e=window.screen||{width:window.innerWidth,height:window.innerHeight,colorDepth:8
};return{platform:window.navigator.platform||null,userAgent:window.navigator.userAgent||null,
"User-Language":window.navigator.language||null,Browser:window.navigator.appCodeName||null,
"Browser-Name":window.navigator.appName||null,"Browser-Version":window.navigator.appVersion||null,
"Browser-Width":window.innerWidth||0,"Browser-Height":window.innerHeight||0,"Document-Mode":document.documentMode||null,
"Screen-Width":e.width,"Screen-Height":e.height,"Color-Depth":e.colorDepth,UtcOffset:(new Date).getTimezoneOffset()/-60,
cookieEnabled:window.navigator.cookieEnabled||null,doNotTrack:window.navigator.doNotTrack||null,
languages:window.navigator.languages||null,support:{polyfill:window.polyfillLoaded||0,jquery:window.jQuery?1:0,
promise:window.Promise?1:0,fetch:window.fetch?1:0}}}()}},getUrlHistory:function(e){var t;
return window.SITEVARS&&window.SITEVARS.urlHistory&&window.SITEVARS.urlHistory.length?(t=window.SITEVARS.urlHistory,
e=e||o.urlHistory,t.slice(Math.max(t.length-e,0))):[]},getStackTrace:function(e){var t,n,r;
return window.SITEVARS&&window.SITEVARS.stackTrace&&window.SITEVARS.stackTrace.length?(t="",n=[],
window.SITEVARS.stackTrace.forEach(function(e){t===e?n[n.length-1].count++:(n.push({label:e,count:1}),t=e)}),e=e||o.stackTrace,
n=n.slice(Math.max(n.length-e,0)),r=[],n.forEach(function(e){1<e.count?r.push(e.label+" (x"+e.count+")"):r.push(e.label)}),r):[]
},isDev:function(){return s}};var i,r,o={stackTrace:100,urlHistory:10},a={0:"EEE",1:"AAA",2:"222",3:"00F",error:"C00",
label:"C0C"},s=window.location.hostname&&!window.location.hostname.match(/www\.drugs\.com/);function c(e){var t=[];l()&&(
e&&"hide"!==e||t.push("hide: "+JSON.stringify(i.hide)),e&&"show"!==e||t.push("show: "+JSON.stringify(i.show)),
e&&"mark"!==e||t.push("mark: "+JSON.stringify(i.mark)),d("{"+t.join(", ")+"}","label"))}function u(e){g(),e.hide&&(i.hide=e.hide
),e.show&&(i.show=e.show),e.mark&&(i.mark=e.mark);e=i;return e=JSON.stringify(e),window.localStorage.setItem("DDC.Debug.options"
,e),i}function d(e,t){t&&window.console&&(t="color: #"+a[t],window.console.log("%c%s",t,e))}function l(){
return i&&"object"===_typeof(i)}function g(){(i=i||{}).hide=i.hide||[],i.show=i.show||[],i.mark=i.mark||[]}},{}],14:[function(e,
t,n){t.exports={init:function(){r.Debug.trace("DDC.Drug.init"),r.Utils.queryAll("[data-box-info-module]").forEach(function(e){
return e.addEventListener("click",o)}),r.Utils.queryAll("[data-drug-imprint-image]").forEach(function(e){
return e.addEventListener("click",a)}),r.Utils.addGlobalEventListener("click","[data-action=drug-dosage-disambiguation]",s)}};
var r={Api:e("./api"),Config:e("./config"),Debug:e("./debug"),Modal:e("./modal"),Utils:e("./utils")},i={
drugStatus:"/api/drug/status/",conditionLinks:"/api/condition/links/"};function o(e){r.Debug.trace("DDC.Drug.requestBoxInfo");
var e=e.currentTarget,t=e.getAttribute("data-box-info-module"),n=e.getAttribute("aria-controls");t&&(e.removeAttribute(
"data-box-info-module"),e.removeEventListener("click",o),t=function(e,t){if(r.Debug.trace("DDC.Drug.getBoxInfoUrl",e),"drug"===e
)return n=["id="+t.getAttribute("data-id"),"ddc_id="+t.getAttribute("data-ddc_id"),"brand_name_id="+t.getAttribute(
"data-brand_name_id")],i.drugStatus+t.getAttribute("data-type")+"/?"+n.join("&");if("condition"!==e)throw new Error(
"Module '"+e+"' not recognized");var n=["doc_url="+t.getAttribute("data-doc_url"),"doc_title="+t.getAttribute("data-doc_title"),
"doc_file="+t.getAttribute("data-doc_file")];return i.conditionLinks+t.getAttribute("data-type")+"/?"+n.join("&")}(t,e),
r.Api.get(t).then(function(e){return e=e,t=n,r.Debug.trace("DDC.Drug.displayBoxInfo",t),void(document.querySelector("#"+t
).innerHTML=e);var t}))}function a(e){r.Debug.trace("DDC.Drug.changeImprintImage"),e.preventDefault(),e.stopPropagation();
var e=e.currentTarget,t=document.querySelector("#drug-imprint-primary"),n=e.getAttribute("src")||e.querySelector("img"
).getAttribute("src");t.querySelector("img").setAttribute("src",n),t.querySelector("a").setAttribute("href",e.getAttribute(
"data-url")),t.querySelector(".drugImageText").innerHTML=e.getAttribute("data-label")}function s(e){r.Debug.trace(
"DDC.Drug.promptDosageDisambiguation"),e.preventDefault(),e.stopPropagation();var t=e.target.closest("[data-ddc_id]");
t.getAttribute("data-ddc_id")&&(e="/js/async/dosage-disambiguation.php?"+["ddc_id="+t.getAttribute("data-ddc_id"),
"brand_name_id="+t.getAttribute("data-brand_id")].join("&"),r.Modal.setConfig({type:"drug-dosage",width:400}),r.Api.get(e).then(
function(e){return r.Modal.show(e)}).catch(function(){window.location.href=t.getAttribute("href")}))}},{"./api":10,
"./config":11,"./debug":13,"./modal":26,"./utils":33}],15:[function(e,t,n){function o(e,t){var n=a(e[0],o=e[1],i=e[2],r=e[3],t[0
],7,-680876936),r=a(r,n,o,i,t[1],12,-389564586),i=a(i,r,n,o,t[2],17,606105819),o=a(o,i,r,n,t[3],22,-1044525330);n=a(n,o,i,r,t[4]
,7,-176418897),r=a(r,n,o,i,t[5],12,1200080426),i=a(i,r,n,o,t[6],17,-1473231341),o=a(o,i,r,n,t[7],22,-45705983),n=a(n,o,i,r,t[8],
7,1770035416),r=a(r,n,o,i,t[9],12,-1958414417),i=a(i,r,n,o,t[10],17,-42063),o=a(o,i,r,n,t[11],22,-1990404162),n=a(n,o,i,r,t[12],
7,1804603682),r=a(r,n,o,i,t[13],12,-40341101),i=a(i,r,n,o,t[14],17,-1502002290),n=c(n,o=a(o,i,r,n,t[15],22,1236535329),i,r,t[1],
5,-165796510),r=c(r,n,o,i,t[6],9,-1069501632),i=c(i,r,n,o,t[11],14,643717713),o=c(o,i,r,n,t[0],20,-373897302),n=c(n,o,i,r,t[5],5
,-701558691),r=c(r,n,o,i,t[10],9,38016083),i=c(i,r,n,o,t[15],14,-660478335),o=c(o,i,r,n,t[4],20,-405537848),n=c(n,o,i,r,t[9],5,
568446438),r=c(r,n,o,i,t[14],9,-1019803690),i=c(i,r,n,o,t[3],14,-187363961),o=c(o,i,r,n,t[8],20,1163531501),n=c(n,o,i,r,t[13],5,
-1444681467),r=c(r,n,o,i,t[2],9,-51403784),i=c(i,r,n,o,t[7],14,1735328473),n=u(n,o=c(o,i,r,n,t[12],20,-1926607734),i,r,t[5],4,
-378558),r=u(r,n,o,i,t[8],11,-2022574463),i=u(i,r,n,o,t[11],16,1839030562),o=u(o,i,r,n,t[14],23,-35309556),n=u(n,o,i,r,t[1],4,
-1530992060),r=u(r,n,o,i,t[4],11,1272893353),i=u(i,r,n,o,t[7],16,-155497632),o=u(o,i,r,n,t[10],23,-1094730640),n=u(n,o,i,r,t[13]
,4,681279174),r=u(r,n,o,i,t[0],11,-358537222),i=u(i,r,n,o,t[3],16,-722521979),o=u(o,i,r,n,t[6],23,76029189),n=u(n,o,i,r,t[9],4,
-640364487),r=u(r,n,o,i,t[12],11,-421815835),i=u(i,r,n,o,t[15],16,530742520),n=d(n,o=u(o,i,r,n,t[2],23,-995338651),i,r,t[0],6,
-198630844),r=d(r,n,o,i,t[7],10,1126891415),i=d(i,r,n,o,t[14],15,-1416354905),o=d(o,i,r,n,t[5],21,-57434055),n=d(n,o,i,r,t[12],6
,1700485571),r=d(r,n,o,i,t[3],10,-1894986606),i=d(i,r,n,o,t[10],15,-1051523),o=d(o,i,r,n,t[1],21,-2054922799),n=d(n,o,i,r,t[8],6
,1873313359),r=d(r,n,o,i,t[15],10,-30611744),i=d(i,r,n,o,t[6],15,-1560198380),o=d(o,i,r,n,t[13],21,1309151649),n=d(n,o,i,r,t[4],
6,-145523070),r=d(r,n,o,i,t[11],10,-1120210379),i=d(i,r,n,o,t[2],15,718787259),o=d(o,i,r,n,t[9],21,-343485551),e[0]=l(n,e[0]),e[
1]=l(o,e[1]),e[2]=l(i,e[2]),e[3]=l(r,e[3])}function s(e,t,n,r,i,o){return t=l(l(t,e),l(r,o)),l(t<<i|t>>>32-i,n)}function a(e,t,n
,r,i,o,a){return s(t&n|~t&r,e,t,i,o,a)}function c(e,t,n,r,i,o,a){return s(t&r|n&~r,e,t,i,o,a)}function u(e,t,n,r,i,o,a){
return s(t^n^r,e,t,i,o,a)}function d(e,t,n,r,i,o,a){return s(n^(t|~r),e,t,i,o,a)}t.exports={md5:function(e){return function(e){
for(var t=0;t<e.length;t++)e[t]=function(e){for(var t="",n=0;n<4;n++)t+=r[e>>8*n+4&15]+r[e>>8*n&15];return t}(e[t]);
return e.join("")}(function(e){var t,n=e.length,r=[1732584193,-271733879,-1732584194,271733878];for(t=64;t<=e.length;t+=64)o(r,
function(e){for(var t=[],n=0;n<64;n+=4)t[n>>2]=e.charCodeAt(n)+(e.charCodeAt(n+1)<<8)+(e.charCodeAt(n+2)<<16)+(e.charCodeAt(n+3
)<<24);return t}(e.substring(t-64,t)));e=e.substring(t-64);var i=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];for(t=0;t<e.length;t++)i[t>>2
]|=e.charCodeAt(t)<<(t%4<<3);if(i[t>>2]|=128<<(t%4<<3),55<t)for(o(r,i),t=0;t<16;t++)i[t]=0;return i[14]=8*n,o(r,i),r}(e))}};
var r="0123456789abcdef".split("");function l(e,t){return e+t&4294967295}},{}],16:[function(e,t,n){t.exports={log:function(e){
var t=e.code?e.code+" "+e.text:e.text,n=e.file||function(){if(document.currentScript&&document.currentScript.src
)return document.currentScript.src;var e=document.getElementsByTagName("script");return e[e.length-1].src}(),e=e.line||1;r(t,n,e
,0,null)}};var a={Debug:e("./debug")},s=0,c="/api/log/js/";function r(e,t,n,r,i){var o;9<s||((o=a.Debug.getData()).error={
count:s,message:e||null,file:t||null,line:n||null,column:r||null,stack:i&&i.stack?i.stack:null},o.history=a.Debug.getUrlHistory(
),o.stack=a.Debug.getStackTrace(),o.config=window.SITECONFIG||{},window.console&&a.Debug.isDev()&&(
e=o.error.message+"\n"+o.error.file+"\nLine: "+o.error.line+", Column: "+o.error.column+"\n"+o.error.stack,window.console.log(
"%c"+e,"color: #F00"),window.console.dir(o)),function(e){if(!(e.request.url&&e.error.message&&e.error.file&&e.error.line)
)return 1;if(!e.error.file.match(/\.js(\?|$)/))return 1;if(!e.request.url.match(/^https?:\/\/www\.drugs\.com/))return 1;if(
!e.error.file.match(/^https?:\/\/www\.drugs\.com/))return 1;if(e.error.file.match(/prebid.+\.js/))return 1;if(
e.error.file.match(/[A-Z0-9-]{10,}\/main\.js/))return 1;return"Script error."===e.error.message.toString()}(o)||(t=o,
window.fetch&&(t={method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/json"},body:JSON.stringify(t)},
window.fetch(c,t)),s++))}window.onerror=r},{"./debug":13}],17:[function(e,t,n){t.exports={init:function(){i.Debug.trace(
"DDC.Fixable.init");var t=i.Config.get(["fixable","items"]);t&&Array.isArray(t)&&(t=t.filter(function(e){return Boolean(
document.querySelector(e.targetSelector))})).forEach(function(n,e){n.isLast=e===t.length-1,window.setTimeout(function(){var e=n;
{var t;i.Debug.trace("DDC.Fixable.setup",e),e.leaderboard&&e.targetSelector&&(t=e,i.Debug.trace(
"DDC.Fixable.setupStickyLeaderboard",t),(r=document.querySelector(t.targetSelector))&&(t=r.clientHeight,window.setTimeout(o,
function(e){if(i.Debug.trace("DDC.Fixable.getStickyDuration",e),window.location.hash)return 2e3;if(.2<e/window.innerHeight
)return 3e3;if(250<e)return 7e3;if(90<e)return 11e3;return 15e3}(t))))}e.maximizeStickyHeight&&e.isLast&&(t=e,i.Debug.trace(
"DDC.Fixable.maximizeSidebarStickyHeight",t.targetSelector,t.containerSelector),(e=document.querySelector(t.targetSelector)
)&&e.parentNode&&(e=e.parentNode,t=document.querySelector(t.containerSelector).clientHeight,(t=Math.round(t-e.offsetTop)
)>1.5*e.clientHeight&&(e.style.height=t+"px")))},n.delay)})}};var r,i={Config:e("./config"),Debug:e("./debug")};function o(){
var e,t;i.Debug.trace("DDC.Fixable.removeStickyLeaderboard"),!r.classList||r.classList.contains("is-animate"
)||r.classList.contains("is-static")||(e=window.scrollY||window.pageYOffset||0,t=100+r.clientHeight,r.classList.add(
t<e?"is-animate":"is-static"))}},{"./config":11,"./debug":13}],18:[function(e,t,n){t.exports={String:{encode:function(e){var t={
"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#x2F;"};return String(e).replace(/[&<>"'/]/g,function(e){
return t[e]})},ucWords:function(e){var n=[],r=["above","after","an","and","at","before","below","but","by","during","for","in",
"of","or","taking","the","to","toward","using","versus","vs","with","your"];return e.split(" ").forEach(function(e,t){
e.toLowerCase()!==e||r.includes(e)&&0!==t||(e=e.replace(/(^([a-zA-Z\p{M}]))|([( -][a-zA-Z\p{M}])/g,function(e){
return e.toUpperCase()})),n.push(e)}),n.join(" ")},convertNumber:function(e){var t=Number(e);return!e||!e.length||Array.isArray(
e)||isNaN(t)?e:t},parseMySQLDate:function(e){if(!e)return 0;e=e.split(/[- :]/);3===e.length&&Array.prototype.push.apply(e,["00",
"00","00"]);return 0!==parseInt(e[0])?new Date(Date.UTC(e[0],e[1]-1,e[2],e[3],e[4],e[5])).getTime():0},escapeForRegex:i},Date:{
formatDate:function(e,t){e=e instanceof Date?e:new Date(e);var n="am",r=e.getHours();0===r?r=12:12<r&&(r-=12,n="pm");return t=(
t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=(t=t.replace("yyyy",e.getFullYear().toString())).replace("yy",e.getFullYear(
).toString().substring(2,4))).replace("HH",e.getHours().toString().padStart(2,"0"))).replace("H",e.getHours().toString())
).replace("hh",r.toString().padStart(2,"0"))).replace("h",r.toString())).replace("mm",e.getMinutes().toString().padStart(2,"0"))
).replace("m",e.getMinutes().toString())).replace("tt",n)).replace("MMMM",o(e.getMonth()))).replace("MMM",o(e.getMonth(),3))
).replace("MM",(e.getMonth()+1).toString().padStart(2,"0"))).replace("dddd","__DDDD__")).replace("ddd","__DDD__")).replace("dd",
e.getDate().toString().padStart(2,"0"))).replace("d",e.getDate().toString())).replace("__DDDD__",a(e.getDay()))).replace(
"__DDD__",a(e.getDay(),3))},formatMySQLDate:function(e){return e.toISOString().slice(0,19).replace("T"," ")}},Object:{
clone:function(e){return JSON.parse(JSON.stringify(e))},safeStringify:function(e){r.Debug.trace("DDC.Helper.safeStringify");
var n=[],e=JSON.stringify(e,function(e,t){if("object"===_typeof(t)&&null!==t){if(-1!==n.indexOf(t))return;n.push(t)}return t});
return n=null,e}},getUrlParameter:function(e,t){r.Debug.trace("DDC.Helper.getUrlParameter");t=t?t.substring(t.indexOf("?")
):window.location.search,e=new RegExp("[\\?&]"+i(e)+"=([^&#]*)").exec(t);return null===e?"":decodeURIComponent(e[1].replace(
/\+/g," "))}};var r={Debug:e("./debug")};function i(e){return e.replace(/[-/\\^$*+?.()|[\]{}]/g,"\\$&")}function o(e,t){
e="January February March April May June July August September October November December".split(" ")[e]||"N/A";
return t?e.substring(0,t):e}function a(e,t){e="Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" ")[e]||"N/A";
return t?e.substring(0,t):e}},{"./debug":13}],19:[function(e,t,n){t.exports={load:function(){return o.Debug.trace(
"DDC.Identity.load"),i=i||o.Config.get(["identityLink"]),new Promise(function(e){var n,t,r;i?i.data&&i.data.length?a(i,e):(n=e,
o.Debug.trace("DDC.Identity.getUserData"),i.api&&i.api.url?i.cookie&&i.cookie.link&&i.cookie.data?(t=o.Cookie.get(i.cookie.link)
,r=o.Cookie.get(i.cookie.data),t?n("Identity link already exists"):r?o.Api.get(i.api.url).then(function(e){return e=e,t=n,
o.Debug.trace("DDC.Identity.parseUserData"),void(e&&e.user&&e.user.identity&&e.user.identity.pid&&e.user.identity.data?a(
e.user.identity,t):t("No identity data from API"));var t}):n("No cookie data found")):n("No cookie config found"):n(
"No API config found")):e("No config found")})}};var i,o={Api:e("./api"),Config:e("./config"),Cookie:e("./cookie"),Debug:e(
"./debug"),Load:e("./load")},r="https://ats.rlcdn.com/ats.js";function a(e,t){o.Debug.trace("DDC.Identity.getEnvelope",e);
var n={placementID:e.pid,emailHashes:e.data};o.Load.addScriptTag(r,{onload:function(){window.ats&&(window.ats.start(n),
window.ats.retrieveEnvelope().then(t))}})}},{"./api":10,"./config":11,"./cookie":12,"./debug":13,"./load":23}],20:[function(e,t,
n){t.exports={init:function(){r.Debug.trace("DDC.Image.init");var e,t=r.Config.get(["page","image"]);t&&(t.lazyLoad&&(
e=t.lazyLoad,r.Debug.trace("DDC.Image.setupLazyLoading",e),r.Intersection.hasSupport()?(e.unobserve=!0,r.Intersection.observe(
e.selector,i,e)):window.setTimeout(function(){r.Utils.queryAll(e.selector).forEach(i)},e.delay)),t.nsfw&&(r.Debug.trace(
"DDC.Image.handleNsfwImages"),r.Utils.queryAll("[data-nsfw-warning]").forEach(function(e){return e.addEventListener("click",a)})
))}};var r={Config:e("./config"),Debug:e("./debug"),Intersection:e("./intersection"),User:e("./user"),Utils:e("./utils")};
function i(e){r.Debug.trace("DDC.Image.load");var t=e.getAttribute("data-src"),n=(t&&o(t).then(function(){e.src=t}).catch(
r.Debug.dir),e.getAttribute("data-background-image"));n&&o(n).then(function(){e.style.backgroundImage="url("+n+")"}).catch(
r.Debug.dir)}function o(e){return e.startsWith("http")||e.startsWith("//")?r.User.getConsent():Promise.resolve()}function a(e){
r.Debug.trace("DDC.Image.displayNsfwImage"),e.preventDefault();var e=e.currentTarget,t=e.nextElementSibling;t&&t.hasAttribute(
"data-nsfw-image")&&(t.setAttribute("src",t.getAttribute("data-src")),t.setAttribute("data-src","loaded"),t.classList.remove(
"ddc-nsfw-image"),r.Utils.removeElement(e))}},{"./config":11,"./debug":13,"./intersection":21,"./user":32,"./utils":33}],21:[
function(e,t,n){t.exports={observe:function(e,n,r){var t;i.Debug.trace("DDC.Intersection.observe",e,r),a()&&(r=r||{},
t=new window.IntersectionObserver(function(e,t){e.forEach(function(e){(e.isIntersecting||r.alwaysCallback)&&(n(e.target,
e.isIntersecting),r.unobserve&&t.unobserve(e.target))})},o(r)),"string"==typeof e?i.Utils.queryAll(e).forEach(function(e){
return t.observe(e)}):t.observe(e))},hasSupport:a,_private:{getOptions:o}};var i={Debug:e("./debug"),Utils:e("./utils")};
function o(e){return{rootMargin:100*(e.screens||0)+"% 0%",threshold:e.threshold||0}}function a(){
return"IntersectionObserver"in window}},{"./debug":13,"./utils":33}],22:[function(e,t,n){t.exports={init:function(){
i.Debug.trace("DDC.List.init"),(r=i.Config.get(["options","classifyLists"]))&&r.wrapper&&r.numItems&&r.charLimit&&(
i.Debug.trace("DDC.List.classify"),i.Utils.queryAll(r.wrapper+" ul").forEach(function(e){var t=e.getBoundingClientRect();if(!(
t&&-1<t.top&&t.bottom<=window.innerHeight||e.closest(".more-resources"))){t=[].slice.call(e.querySelectorAll("li"));if(t&&!(
t.length<r.numItems.short)){t=t,i.Debug.trace("DDC.List.getItemStats"),n={numItems:0,numItemsParagraph:0,maxLength:0},t.forEach(
function(e){e.innerText&&e.innerHTML&&(!r.countHtmlItems&&e.innerHTML!==e.innerText||n.numItems++,(e=e.innerText.length
)>r.charLimit.paragraph&&n.numItemsParagraph++,n.maxLength=Math.max(e,n.maxLength))});var n,t=e,e=n;if(i.Debug.trace(
"DDC.List.addClass",e),t.classList){if(e.numItems>=r.numItems.long)t.classList.add("list-length-long");else if(
e.numItems>=r.numItems.medium)t.classList.add("list-length-medium");else{if(!(e.numItems>=r.numItems.short))return;
t.classList.add("list-length-short")}r.charLimit.content&&e.maxLength>r.charLimit.content?t.classList.add("list-type-content"
):5<e.numItemsParagraph/e.numItems*100?t.classList.add("list-type-paragraph"):t.classList.add("list-type-word")}}}}))}};var r,
i={Config:e("./config"),Debug:e("./debug"),Utils:e("./utils")}},{"./config":11,"./debug":13,"./utils":33}],23:[function(e,t,n){
t.exports={init:function(){return r.Debug.trace("DDC.Load.init"),i("delayedCss",o),i("delayedScripts",a),r.User.getConsent(
).then(function(){r.Debug.trace("DDC.Load.loadUserDeferredScripts"),r.Utils.queryAll("script[type='application/deferred']"
).forEach(function(e){var t,n=e.getAttribute("data-src");n?a(n,{enforceUnique:!0,attributes:(n=e,r.Debug.trace(
"DDC.Load.buildOptionAttributes"),n.attributes?(t=["src","data-src","async","defer","type"],[].slice.call(n.attributes).filter(
function(e){return!t.includes(e.name)})):[])}):(n=e.innerHTML,r.Debug.trace("DDC.Load.addScriptBlock",n),(
e=document.createElement("script")).innerHTML=n,c(e))}),r.Identity.load().then(function(e){r.Debug.trace(
"DDC.Identity.load:complete",e)})}).catch(r.Debug.dir)},addScriptTag:a};var r={Config:e("./config"),Debug:e("./debug"),
Identity:e("./identity"),User:e("./user"),Utils:e("./utils")};function i(e,t){r.Debug.trace("DDC.Load.loadDelayedFiles",e);
e=r.Config.get(["page",e]);e&&Array.isArray(e)&&e.forEach(t)}function o(e){r.Debug.trace("DDC.Load.addStyleSheet",e);
var t=document.createElement("link");t.rel="stylesheet",t.href=e,s(t)}function a(e,t){var n;r.Debug.trace(
"DDC.Load.addScriptTag",e),(t=t||{}).enforceUnique&&0<r.Utils.queryAll("script[src='"+e+"']").length||((
n=document.createElement("script")).async=!0,n.src=e,t.attributes&&t.attributes.forEach(function(e){n.setAttribute(e.name,
e.value)}),t.onload&&(n.onload=t.onload),(t.defer?s:c)(n))}function s(e){r.Debug.trace("DDC.Load.deferLoad",e),
window.requestAnimationFrame(function(){return c(e)})}function c(e){r.Debug.trace("DDC.Load.inject",e),
document.getElementsByTagName("head")[0].appendChild(e)}},{"./config":11,"./debug":13,"./identity":19,"./user":32,"./utils":33}
],24:[function(e,t,n){t.exports={init:function(){r.Debug.trace("DDC.Log.init");var e=function(){r.Debug.trace(
"DDC.Log.collectData");var e=r.Config.get(["dwLog"]);return e?(e.g=document.referrer,e.j=window.location.href,
e.r=window.ehs_ad_called||0,e):null}();e&&(!function(e){r.Debug.trace("DDC.Log.setAnalytics");e=e.r?"Yes":"No";r.Analytics.set(
"dimension59",e)}(e),i("/api/log/dw/",e))},sendData:i};var r={Analytics:e("./analytics"),Config:e("./config"),Debug:e("./debug"
),Helper:e("./helper")};function i(e,t){if(r.Debug.trace("DDC.Log.sendData",e,t),navigator&&navigator.sendBeacon)try{
var n=r.Helper.Object.safeStringify(t);navigator.sendBeacon(e,n)}catch(e){}}},{"./analytics":9,"./config":11,"./debug":13,
"./helper":18}],25:[function(e,t,n){t.exports={init:function(){r.Debug.trace("DDC.Menu.init"),function(){r.Debug.trace(
"DDC.Menu.setupSearchSelect");var e=r.Config.get(["agent"]);e&&!e.isMobile&&r.Utils.queryAll("[data-search-select]").forEach(
function(e){e.addEventListener("change",function(e){var e=e.currentTarget,t=e.options[e.selectedIndex].text;e.closest("form"
).querySelector("[data-search-select-value]").innerText=t})})}(),r.Debug.trace("DDC.Menu.initOffCanvas"),r.Utils.queryAll(
"[data-nav-toggle]").forEach(function(e){e.addEventListener("click",function(e){e.preventDefault(),
document.getElementsByTagName("html")[0].classList.toggle("ddc-nav-open")})}),r.Utils.queryAll("[data-subnav] > a").forEach(
function(e){e.addEventListener("click",function(e){e.preventDefault(),e.currentTarget.closest("[data-subnav]").classList.toggle(
"subnav-open")})})}};var r={Config:e("./config"),Debug:e("./debug"),Utils:e("./utils")}},{"./config":11,"./debug":13,
"./utils":33}],26:[function(e,t,n){t.exports={init:function(){o.Debug.trace("DDC.Modal.init");var e=o.Config.get(["modal"]);
!e||e.cookie&&o.Cookie.get(e.cookie.name)||(c(e),u())},setConfig:c,setup:u,show:l,hide:f,exists:function(){return Boolean(
document.getElementById(a))}};var i,o={Analytics:e("./analytics"),Api:e("./api"),Config:e("./config"),Cookie:e("./cookie"),
Debug:e("./debug"),Intersection:e("./intersection"),Utils:e("./utils")},a="ddc-modal",s={setup:!1,active:!1},r={width:500,
displayClose:!0,overlayClose:!0};function c(e){o.Debug.trace("DDC.Modal.setConfig",e),i=_objectSpread(_objectSpread({},r),e)}
function u(){o.Debug.trace("DDC.Modal.setup"),i.show&&(i.show.selectors&&i.show.selectors.forEach(function(e){
o.Intersection.observe(e,d,{screens:i.show.screens,unobserve:!0})}),i.show.wait&&window.setTimeout(d,i.show.wait))}function d(){
if(o.Debug.trace("DDC.Modal.setupModal"),!s.setup)if(s.setup=!0,i.async)o.Api.get(i.async).then(l);else if(i.content)try{l(atob(
i.content))}catch(e){}}function l(e){var t,n,r;o.Debug.trace("DDC.Modal.show"),e&&((n=function(){var e=document.getElementById(a
);e||((e=document.createElement("div")).id=a,e.setAttribute("role","dialog"),e.setAttribute("tabindex","-1"),e.setAttribute(
"aria-labelledby","ddc-modal-title"),document.body.appendChild(e));return e}()).setAttribute("data-modal-type",i.type||""),(
t=n.classList).remove.apply(t,_toConsumableArray(n.classList)),n.classList.add(a),i.classList&&n.classList.add(i.classList),r=n,
o.Debug.trace("DDC.Modal.setupEventListeners"),window.setTimeout(function(){document.addEventListener("click",g),
i.events=i.events||[],i.events.forEach(function(t){((t.selector?o.Utils.queryAll(t.selector):[r])||[]).forEach(function(e){
return e.addEventListener(t.type,t.listener)})})},100),n.innerHTML=function(e,t){var n=[];n.push(
"<div class='ddc-modal-container'>"),n.push("<div class='ddc-modal-content'>"),n.push(e),n.push("</div>"),t&&n.push(
"<button class='ddc-modal-close' data-modal-close><span class='ddc-sr-only'>Close</span></button>");return n.push("</div>"),
n.join("\n")}(e,i.displayClose),n.style.width=i.width+"px",window.setTimeout(function(){n.classList.add("ddc-modal-visible");
var e=n.querySelector(".ddc-modal-container");e&&e.clientHeight>window.innerHeight&&f()},50),
i.analytics&&i.analytics.show&&o.Analytics.sendEventGTM(i.analytics.show),s.active=!0)}function g(e){o.Debug.trace(
"DDC.Modal.handleClick"),s.active&&e.target&&(i&&i.overlayClose&&!e.target.closest(".ddc-modal-container")&&(e.preventDefault(),
f()),e.target.closest("[data-modal-close]")&&(e.preventDefault(),f(),o.Debug.trace("DDC.Modal.processClose"),
i.analytics&&i.analytics.close&&o.Analytics.sendEventGTM(i.analytics.close),i.cookie&&i.cookie.name&&!o.Cookie.get(i.cookie.name
)&&o.Cookie.set(i.cookie.name,"disabled",i.cookie.expires||30)),e.target.closest("[data-modal-click]")&&(o.Debug.trace(
"DDC.Modal.trackClick"),i.analytics&&i.analytics.click&&o.Analytics.sendEventGTM(i.analytics.click)))}function f(){
o.Debug.trace("DDC.Modal.hide"),document.removeEventListener("click",g);var e=document.getElementById(a);
e&&e.classList&&e.classList.remove("ddc-modal-visible"),s.active=!1}},{"./analytics":9,"./api":10,"./config":11,"./cookie":12,
"./debug":13,"./intersection":21,"./utils":33}],27:[function(e,t,n){t.exports={init:function(){var e;if(i.Debug.trace(
"DDC.NativeApp.init"),!r&&(r=!0,(e=i.Config.get(["nativeApp"]))&&e.version&&("DCUBER"===e.appSrc||"DCUBERA"===e.appSrc))){if(
"DCUBER"===e.appSrc){i.Debug.trace("DDC.NativeApp.iOSjsBridgeSetup"),window.ddcUberMessageHandlers={};try{
window.webkit&&window.webkit.messageHandlers&&(window.ddcUberMessageHandlers.instance=window.webkit.messageHandlers,
window.ddcUberMessageHandlers.SetDescription=function(e){
window.ddcUberMessageHandlers.instance.webViewSetDescription.postMessage(e)},
window.ddcUberMessageHandlers.SetMednotesManifest=function(e){
window.ddcUberMessageHandlers.instance.webViewSetManifest.postMessage(e)},window.ddcUberMessageHandlers.PrintPage=function(e){
window.ddcUberMessageHandlers.instance.webviewPrintPage.postMessage(e)},window.ddcUberMessageHandlers.SendLog=function(e){
window.ddcUberMessageHandlers.instance.webviewSendLog.postMessage(e)},
window.ddcUberMessageHandlers.SetMednotesSchedules=function(e){
window.ddcUberMessageHandlers.instance.webviewSetMednotesSchedules.postMessage(e)},
window.ddcUberMessageHandlers.SetShareUrl=function(e){window.ddcUberMessageHandlers.instance.webviewSetShareUrl.postMessage(e)})
}catch(e){}}document.addEventListener("DDC.NativeApp.memoryWarning",function(e){if(e&&e.detail&&e.detail.value){
var e=e.detail.value,t=(i.Debug.trace("DDC.NativeApp.handleMemoryWarning",e),i.Config.get(["nativeApp"]));if(o++,t.memoryWarning
){if(t.memoryWarning.log&&o>=t.memoryWarning.log){e=function(e){i.Debug.trace("DDC.NativeApp.getMemoryLogData");
var t=i.Debug.getData();return t.nativeApp={event:"memory warning",level:e},t}(e);i.Debug.trace("DDC.NativeApp.sendLog");try{
var n,r=window.ddcUberMessageHandlers;r&&r.SendLog&&(n=window.JSON.stringify(e),r.SendLog(n))}catch(e){}}
t.memoryWarning.ads&&o>=t.memoryWarning.ads&&i.Page.removeAds()}}}),i.Debug.trace("DDC.NativeApp.setPageDescription");try{var t,
n=window.ddcUberMessageHandlers;n&&n.SetDescription&&(t=function(){var e,t=document.querySelector("[name=description]");t&&(
e=t.getAttribute("content"));return e||"Drugs.com"}(),n.SetDescription(t))}catch(e){}}}};var i={Config:e("./config"),Debug:e(
"./debug"),Page:e("./page")},r=!1,o=0},{"./config":11,"./debug":13,"./page":28}],28:[function(e,t,n){t.exports={init:function(){
r.Debug.trace("DDC.Page.init"),window.addEventListener("hashchange",i),i(),r.Utils.addGlobalEventListener("click",
"[data-toggle-class]",o),r.Utils.queryAll("[data-load-html]").forEach(function(e){return e.addEventListener("click",a)}),
r.Utils.queryAll("[data-send-data]").forEach(function(e){return e.addEventListener("click",s)}),r.Utils.queryAll(
"[data-more-toggle]").forEach(function(e){return e.addEventListener("click",u)}),r.Utils.queryAll("[data-action=print]"
).forEach(function(e){return e.addEventListener("click",d)}),function(){var e=window.navigator.userAgent;(0<e.indexOf("MSIE "
)||0<e.indexOf("Trident/"))&&(window.onbeforeprint=g)}(),window.setTimeout(f,5e3)},removeAds:g,getPageViewCount:function(){
return parseInt(r.Cookie.get("ddc-pvc")||0)+1}};var r={Api:e("./api"),Config:e("./config"),Cookie:e("./cookie"),Debug:e(
"./debug"),Utils:e("./utils")};function i(){r.Debug.trace("DDC.Page.hashChange"),
window.location&&window.location.hash&&window.location.hash.length&&document.body.classList.add("hash-url")}function o(e,t){
r.Debug.trace("DDC.Page.toggleClass");var n=t.getAttribute("data-toggle-class");n&&(t.hasAttribute("data-allow-default")||(
e.preventDefault(),e.stopPropagation()),t.closest(n).classList.toggle("ddc-toggle-active"))}function a(e){r.Debug.trace(
"DDC.Page.loadHtml"),e.preventDefault(),e.stopPropagation();var t=e.currentTarget,n=t.closest("[data-load-html-target]"),e=c(t,
"data-load-html");r.Api.get(e).then(function(e){n?n.innerHTML=e.trim():(t.insertAdjacentHTML("afterend",e.trim()),
r.Utils.removeElement(t))})}function s(e){r.Debug.trace("DDC.Page.sendData");e=c(e.currentTarget,"data-send-data");r.Api.get(e)}
function c(e,t){var n=e.getAttribute(t);return e.removeAttribute(t),n+"?"+function(e){for(var t=[],n=0;n<e.attributes.length;n++
){var r=e.attributes[n];r.name.startsWith("data-")&&t.push(r.name.replace("data-","")+"="+r.value)}return t}(e).join("&")}
function u(e){r.Debug.trace("DDC.Page.expandMoreLink"),e.preventDefault(),e.stopPropagation();var t,e=e.target.closest(
"[data-more-config-id]");e&&(t=e.getAttribute("data-more-config-id"),(t=r.Config.get(["moreResources",t]))&&(
e.insertAdjacentHTML("afterend",t.trim()),r.Utils.removeElement(e)))}function d(e){r.Debug.trace("DDC.Page.handlePrint"),
e.preventDefault(),e.stopPropagation(),window.setTimeout(l,100)}function l(){r.Debug.trace("DDC.Page.launchPrintPrompt"),
document&&"function"==typeof document.queryCommandSupported&&document.queryCommandSupported("print")?document.execCommand(
"print",!1,null):window&&"function"==typeof window.print&&window.print()}function g(){r.Debug.trace("DDC.Page.removeAds"),
r.Utils.queryAll("body iframe").forEach(r.Utils.removeElement)}function f(){var e=parseInt(r.Cookie.get("ddc-pvc")||0);
r.Cookie.set("ddc-pvc",e+1,1)}},{"./api":10,"./config":11,"./cookie":12,"./debug":13,"./utils":33}],29:[function(e,t,n){
t.exports={init:function(){o.Debug.trace("DDC.Search.init"),o.Utils.queryAll(c.input).forEach(u),o.Utils.queryAll(c.close
).forEach(function(e){return e.addEventListener("click",h)})}};var i,o={Api:e("./api"),Debug:e("./debug"),Utils:e("./utils")},
a=300,r=[],s={},c={wrap:".livesearch-wrap",input:".livesearch",select:"[data-search-select]",close:"[data-search-close]",
containerId:"ls-wrap",item:"[data-livesearch-item]",focusClass:"ls-focus",valueClass:"search-has-value"};function u(e){
o.Debug.trace("DDC.Search.setup",e),e.setAttribute("autocapitalize","off"),e.setAttribute("autocomplete","off"),e.setAttribute(
"autocorrect","off"),e.addEventListener("focus",d),e.addEventListener("keyup",l),e.closest("form").addEventListener("submit",g)}
function d(e){o.Debug.trace("DDC.Search.inputFocus");var t=e.currentTarget.getAttribute("id")+"-active";r.push(t),
document.body.classList.add(t),l(e)}function l(r){window.setTimeout(function(){return n=r.target,o.Debug.trace(
"DDC.Search.processInput"),void(("livesearch-main"===n.id||n.value&&n.value!==i)&&(e=n.closest("form"),(t=[]).push("id="+n.id),
!n.value&&n.dataset.value?(i=n.dataset.value,t.push("t=1")):i=n.value,t.push("s="+i),[].slice.call(e.attributes).forEach(
function(e){e.name.startsWith("data-")&&!e.name.startsWith("data-gtm-")&&t.push(e.name+"="+e.value)}),e.classList.add(
c.valueClass),function(t){if(o.Debug.trace("DDC.Search.fetchResult",t),s[t])return Promise.resolve(s[t]);return o.Api.get(t
).then(function(e){return s[t]=e})}("/js/search/?"+t.join("&")).then(function(e){return t=n,e=e,o.Debug.trace(
"DDC.Search.display"),void(e&&(function(e){o.Debug.trace("DDC.Search.getContainer");var t=document.getElementById(c.containerId)
return t||(e=e.closest(c.wrap)||e.parentNode,(t=document.createElement("div")).id=c.containerId,t.style.top=(
e.offsetHeight||e.clientHeight)+"px",e.style.position="relative",e.appendChild(t),document.addEventListener("click",p),
document.addEventListener("keydown",f)),t}(t).innerHTML=e));var t})));var n,e,t},a)}function g(e){o.Debug.trace(
"DDC.Search.submitForm");var t=e.target.querySelector(c.input);!t.value&&t.getAttribute("data-required")?(e.preventDefault(),
t.focus()):(t=e.target.querySelector(c.select))&&!t.value&&t.setAttribute("disabled",!0)}function f(e){o.Debug.trace(
"DDC.Search.navigate",e.keyCode);var t,n,r=parseInt(e.keyCode||e.which);27===r&&(b(document.querySelector("form."+c.valueClass))
,D()),[38,40].includes(r)&&(e.preventDefault(),(n=document.querySelector("."+c.focusClass))?(n.classList.remove(c.focusClass),
t=function(e,t,n){o.Debug.trace("DDC.Search.getSibling",t,n);do{if((e="next"===t?e.nextElementSibling:e.previousElementSibling
)&&e.matches(n))return e}while(e);return null}(n,38===r?"prev":"next",c.item)):40===r&&(t=document.querySelector(c.item)),t?(
t.classList.add(c.focusClass),t.focus()):(n=e.target.closest("form")||e.target.closest(c.wrap))&&n.querySelector(c.input).focus(
))}function p(e){o.Debug.trace("DDC.Search.defocus");var t,n=e.target,r=document.getElementById(c.containerId),i=function(e){if(
e&&"function"==typeof e.closest)return e.closest(c.item);return null}(n);if(i)e=e,t=r,i=i,o.Debug.trace(
"DDC.Search.processSelection"),(t.closest("form")||t.closest(c.wrap)).querySelector(c.input).value="clear"===i.getAttribute(
"data-livesearch-action")?"":i.innerText,i.getAttribute("href").startsWith("#")&&e.preventDefault(),D(t);else{do{if(
n===r.parentNode)return}while(n=n.parentNode);D(r)}}function h(e){o.Debug.trace("DDC.Search.reset"),e.preventDefault(),D(),b(
e.target.closest("form"))}function b(e){var t;e&&((t=e.querySelector(c.input))&&(t.value=""),e.classList.remove(c.valueClass))}
function D(e){o.Debug.trace("DDC.Search.remove"),i="",(e=e||document.getElementById(c.containerId))&&e.parentNode.removeChild(e)
,r.forEach(function(e){return document.body.classList.remove(e)}),r.length=0,document.removeEventListener("click",p),
document.removeEventListener("keydown",f)}},{"./api":10,"./debug":13,"./utils":33}],30:[function(e,t,n){t.exports={
init:function(){var i,e;o.Debug.trace("DDC.Share.init"),(r=o.Config.get(["share"]))&&(r.sticky&&r.types&&(o.Debug.trace(
"DDC.Share.buildStickyBar"),(e=document.querySelector(r.sticky.target))&&(i=[],r.types.forEach(function(e){return i.push((e=e,
o.Debug.trace("DDC.Share.createSocialLink"),t={href:e.mailUrl?e.mailUrl+"&subject="+encodeURIComponent(document.title):function(
e){return e.replace("SHAREURL",encodeURIComponent(window.location.href)).replace("SHARETITLE",encodeURIComponent(document.title)
)}(e.shareUrl),rel:"noopener noreferrer nofollow",target:"_blank",title:e.label,class:e.cssClass,"data-action":a.social,
"data-width":e.width,"data-height":e.height},n=[],Object.keys(t).forEach(function(e){n.push(e+'="'+t[e]+'"')}),(r=[]).push(
"<a "+n.join(" ")+">"),r.push(e.icon),r.push("<span class='"+e.labelClass+"'>"+e.title+"</span>"),r.push("</a>"),r.join("")));
var t,n,r}),e.innerHTML=i.join("\n"))),o.Utils.addGlobalEventListener("click","[data-action]",s))}};var o={Api:e("./api"),
Config:e("./config"),Debug:e("./debug"),Modal:e("./modal"),Utils:e("./utils")},r={},a={social:"share-social",
mednotes:"share-mednotes"};function s(e,t){o.Debug.trace("DDC.Share.launch");var n=t.getAttribute("data-action");n===a.social?(
e.preventDefault(),t=t,o.Debug.trace("DDC.Share.launchSocial"),t={url:t.getAttribute("href"),title:t.getAttribute("title"),
width:parseInt(t.getAttribute("data-width")),height:parseInt(t.getAttribute("data-height"))},window.open(t.url,"window_"+t.title
,"width="+t.width+",height="+t.height+",scrollbars=1"),o.Modal.hide()):n===a.mednotes&&(e.preventDefault(),o.Debug.trace(
"DDC.Share.launchMednotes"),c({saveButton:r.mednotes.saveButton}))}function i(e){o.Debug.trace("DDC.Share.processMednotes"),
e.preventDefault();for(var t=e.target.closest("form"),n={target:t,data:{}},r=0;r<t.elements.length;r++){var i=t.elements[r];
i.name&&(n.data[i.name]=i.value.trim())}c(n)}function c(e){o.Debug.trace("DDC.Share.requestMednotesModal",e);o.Debug.trace(
"DDC.Share.getDrugObject");var t=(t=o.Config.get(["drugs"]))&&t.length&&t[0].ddc_id?t[0]:null;t&&(t={
referrer:window.location.pathname,form:e,drug:t},o.Modal.setConfig(function(e){o.Debug.trace("DDC.Share.getMednotesModalOptions"
,e);var t={type:"mednotes-add",width:420};e.saveButton&&(t.events=[{selector:"["+e.saveButton+"]",type:"click",listener:i}]);
return t}(e)),o.Api.post(r.mednotes.apiUrl,t).then(function(e){return o.Modal.show(e)}))}},{"./api":10,"./config":11,
"./debug":13,"./modal":26,"./utils":33}],31:[function(p,h,e){!function(e){!function(){h.exports={init:function(){n.Debug.trace(
"DDC.Toast.init");var e,t=n.Config.get(["toast"]);t&&((r=t.map(a).find(s))?(f("ready"),n.Debug.trace("DDC.Toast.build"),t=(t=[
"ddc-toast"]).concat(r.classList),(e=document.createElement("div")).id="ddc-toast",e.className=t.join(" "),e.innerHTML=function(
){n.Debug.trace("DDC.Toast.getHtml");var e=[r.html];return e.push(
"<a class='ddc-toast-close' data-action='close' href='#'><span class='ddc-sr-only'>Close</span></a>"),e.join("")}(),
document.body.appendChild(e),n.Utils.queryAll("[data-action=process]").forEach(function(e){return e.addEventListener("click",u)}
),n.Utils.queryAll("[data-action=close]").forEach(function(e){return e.addEventListener("click",d)}),o.show=window.setInterval(c
,r.show.wait)):f("disabled"))}};var n={Analytics:p("./analytics"),Config:p("./config"),Cookie:p("./cookie"),Debug:p("./debug"),
Intersection:p("./intersection"),Log:p("./log"),Page:p("./page"),Utils:p("./utils")},r={},i=!1,o={show:0,hide:0},t={show:{
wait:1e3},classList:[],cookie:{name:"ddc-toast",expires:{click:30,close:0}}};function a(e){return e=(e=n.Utils.mergeDeep({},t,e)
).secondary&&n.Page.getPageViewCount()>=e.secondary.pageViewCount?n.Utils.mergeDeep(e,e.secondary):e}function s(e){
return"disabled"!==n.Cookie.get(e.cookie.name)}function c(){n.Debug.trace("DDC.Toast.show"),
void 0!==window.scrollY&&r.show.scroll&&window.scrollY<r.show.scroll||(window.clearInterval(o.show),document.getElementById(
"ddc-toast").classList.add("ddc-toast-show"),document.body.classList.add("page-toast-active"),g("view"),
r.show.ignoreHeaderClose||n.Intersection.observe("#header",e,{alwaysCallback:!0}),r.hide&&r.hide.wait&&(
o.hide=window.setTimeout(l,r.hide.wait)))}function u(){n.Debug.trace("DDC.Toast.process"),
r.ga&&r.ga.category&&r.ga.action&&n.Analytics.sendEvent(r.ga.category,r.ga.action,r.ga.label),g("click"),d()}function d(e){
n.Debug.trace("DDC.Toast.dismiss"),e&&(e.preventDefault(),e.stopPropagation(),g("close")),i=!0,r.cookie.name&&(
e=e?r.cookie.expires.close:r.cookie.expires.click,n.Cookie.set(r.cookie.name,"disabled",e)),l()}function l(){n.Debug.trace(
"DDC.Toast.hide"),window.clearTimeout(o.hide),document.getElementById("ddc-toast").classList.add("ddc-toast-hide"),
document.body.classList.remove("page-toast-active")}function e(e,t){n.Debug.trace("DDC.Toast.toggleDisplay",t),
i||document.getElementById("ddc-toast").classList.toggle("ddc-toast-hide",t)}function g(e){n.Debug.trace("DDC.Toast.trackEvent",
e),f(e),r.gtm&&r.gtm.data&&n.Analytics.sendEventGTM(_objectSpread(_objectSpread({},r.gtm.data),{},{action:e}))}function f(e){
n.Debug.trace("DDC.Toast.log",e),n.Log.sendData("/api/log/toast/",{action:e,config:r,page:n.Config.get(["page"])})}}.call(this)
}.call(this,p("_process"))},{"./analytics":9,"./config":11,"./cookie":12,"./debug":13,"./intersection":21,"./log":24,
"./page":28,"./utils":33,_process:35}],32:[function(f,p,e){!function(e){!function(){p.exports={init:function(){i.Debug.trace(
"DDC.User.init"),r=r||i.Config.get(["user"]),i.Utils.queryAll("[data-authentication]").forEach(function(e){
return e.addEventListener("click",d)}),g()||function(){i.Debug.trace("DDC.User.clearUserCache");try{if(!window.localStorage
)return}catch(e){return}Object.keys(window.localStorage).forEach(function(e){!a.includes(e)&&e.startsWith("DDC."
)&&window.localStorage.removeItem(e)})}()},dismissConsent:function(){i.Debug.trace("DDC.User.dismissConsent"),i.Modal.hide(),
i.Utils.queryAll(n).forEach(function(e){return e.classList.remove(o)}),i.Cookie.set(t,1)},getConsent:function(){if(
i.Debug.trace("DDC.User.getConsent"),!(r=r||i.Config.get(["user"]))||!r.consent)return Promise.reject(new Error(
"DDC.User.getConsent: Undefined config"));if(r.consent.skip)return Promise.resolve();e||(r.consent.useLiveRamp?(i.Debug.trace(
"DDC.User.getTcfApiPromise"),e=new Promise(function(n){window.__tcfapi("addEventListener",2,function(e){if(e&&e.tcString&&[
"cmpuishown","tcloaded","useractioncomplete"].includes(e.eventStatus)){if(e.gdprApplies){if(!window.fetch)return;window.fetch(
"/consent/agree/");var t=i.Cookie.get(r.consent.cookie)||"",e=e.publisher.consents[5]?"agree":"";t!==e&&(i.Cookie.set(
r.consent.cookie,e,e?7:-1),s())}n(!0)}})})):r.consent.useFC?(i.Debug.trace("DDC.User.getTcfApiPromise"),e=new Promise(function(t
){window.googlefc=window.googlefc||{},window.googlefc.ccpa=window.googlefc.ccpa||{},
window.googlefc.callbackQueue=window.googlefc.callbackQueue||[],window.googlefc.callbackQueue.push({CONSENT_DATA_READY:function(
){window.__tcfapi("getTCData",0,function(e){return e.gdprApplies&&(i.Cookie.get(r.consent.cookie)||"")!==(
e=e.publisher.consents[5]?"agree":"")&&(i.Cookie.set(r.consent.cookie,e,e?7:-1),s()),t(!0)})}})})):r.consent.api&&(e=i.Api.get(
r.consent.api.url).then(c)));return i.Utils.queryAll("[data-user-show-consent]").forEach(function(e){return e.addEventListener(
"click",u)}),e},isAuthenticated:g};var r,e,i={Analytics:f("./analytics"),Api:f("./api"),Config:f("./config"),Cookie:f("./cookie"
),Debug:f("./debug"),Modal:f("./modal"),Utils:f("./utils")},t="SetTermsStatus",n=".ddc-notification-gdpr",o="invisible",a=[
"DDC.Debug.options"];function s(){i.Debug.trace("DDC.User.checkConsentAction");for(var e=["/account/","/answers/","/mednotes/"],
t=0;t<e.length;t++)-1!==location.href.indexOf(e[t])&&(r.urlLogout?window.location.href=r.urlLogout:document.location.reload())}
function c(e){return i.Debug.trace("DDC.User.process"),e&&e.user?e.user.gdpr&&e.user.gdpr.modal?i.Cookie.get(t)?Promise.reject(
new Error("DDC.User.process: Consent rejected")):(i.Modal.setConfig(e.user.gdpr.modal),i.Modal.setup(),i.Utils.queryAll(n
).forEach(function(e){return e.classList.add(o)}),Promise.reject(new Error("DDC.User.process: Consent required"))
):Promise.resolve():Promise.reject(new Error("DDC.User.process: Invalid response"))}function u(){i.Debug.trace(
"DDC.User.showConsent"),r.consent.useLiveRamp?window.__tcfapi("showConsentManager",2):r.consent.api&&(i.Cookie.remove(t),
i.Api.get(r.consent.api.url).then(c))}function d(e){var t,n;i.Debug.trace("DDC.User.checkAuthentication"),g()||(t=(
n=e.currentTarget).getAttribute("data-authentication"),n=n.getAttribute("data-authentication-referrer")||n.getAttribute("href"),
t&&(e.preventDefault(),e.stopPropagation(),i.Api.get(r.modal.login+"?type="+t+"&referrer="+encodeURIComponent(n)).then(l),
i.Analytics.sendEventGTM({event:"authentication",content_section:t,url:n})))}function l(e){i.Debug.trace(
"DDC.User.processLoginPrompt"),e.authenticated&&(document.location.href=e.referrer),i.Modal.show(e.content)}function g(){
return i.Debug.trace("DDC.User.isAuthenticated"),!!(r=r||i.Config.get(["user"]))&&0<parseInt(r.userid)}}.call(this)}.call(this,
f("_process"))},{"./analytics":9,"./api":10,"./config":11,"./cookie":12,"./debug":13,"./modal":26,"./utils":33,_process:35}],
33:[function(e,t,n){function a(e){for(var t=arguments.length,n=new Array(1<t?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];if(!n.length
)return e;var i=n.shift();if(s(e)&&s(i))for(var o in i)s(i[o])?(e[o]||Object.assign(e,_defineProperty({},o,{})),a(e[o],i[o])
):Object.assign(e,_defineProperty({},o,i[o]));return a.apply(void 0,[e].concat(n))}function s(e){return e&&"object"===_typeof(e
)&&!Array.isArray(e)}t.exports={queryAll:function(e,t){return t=t||document,[].slice.call(t.querySelectorAll(e))},
removeElement:function(e){return e&&e.parentNode?e.parentNode.removeChild(e):null},addGlobalEventListener:function(e,n,r,t){(
t=t||document.body).addEventListener(e,function(e){var t=e.target.closest(n);t&&r(e,t)})},mergeDeep:a}},{}],34:[function(F,n,r){
!function(q,R){!function(){var e,t;e=this,t=function(){function c(e){return"function"==typeof e}var n=Array.isArray||function(e
){return"[object Array]"===Object.prototype.toString.call(e)},r=0,t=void 0,i=void 0,a=function(e,t){l[r]=e,l[r+1]=t,2===(r+=2
)&&(i?i(g):P())};var e="undefined"!=typeof window?window:void 0,o=e||{},o=o.MutationObserver||o.WebKitMutationObserver,
s="undefined"==typeof self&&void 0!==q&&"[object process]"==={}.toString.call(q),
u="undefined"!=typeof Uint8ClampedArray&&"undefined"!=typeof importScripts&&"undefined"!=typeof MessageChannel;function d(){
var e=setTimeout;return function(){return e(g,1)}}var l=new Array(1e3);function g(){for(var e=0;e<r;e+=2)(0,l[e])(l[e+1]),l[e
]=void 0,l[e+1]=void 0;r=0}function f(){try{var e=Function("return this")().require("vertx");return void 0!==(
t=e.runOnLoop||e.runOnContext)?function(){t(g)}:d()}catch(e){return d()}}var p,h,b,P=void 0;function D(e,t){var n,r=this,
i=new this.constructor(w),o=(void 0===i[m]&&x(i),r._state);return o?(n=arguments[o-1],a(function(){return _(o,i,n,r._result)})
):I(r,i,e,t),i}function y(e){var t;return e&&"object"===_typeof(e)&&e.constructor===this?e:(E(t=new this(w),e),t)}
var P=s?function(){return q.nextTick(g)}:o?(h=0,s=new o(g),b=document.createTextNode(""),s.observe(b,{characterData:!0}),
function(){b.data=h=++h%2}):u?((p=new MessageChannel).port1.onmessage=g,function(){return p.port2.postMessage(0)}):(
void 0===e&&"function"==typeof F?f:d)(),m=Math.random().toString(36).substring(2);function w(){}var v=void 0,A=1,C=2;function H(
e,r,i){a(function(t){var n=!1,e=function(e,t,n,r){try{e.call(t,n,r)}catch(e){return e}}(i,r,function(e){n||(n=!0,(r!==e?E:L)(t,e
))},function(e){n||(n=!0,T(t,e))},t._label);!n&&e&&(n=!0,T(t,e))},e)}function S(e,t,n){var r,i;
t.constructor===e.constructor&&n===D&&t.constructor.resolve===y?(r=e,(i=t)._state===A?L(r,i._result):i._state===C?T(r,i._result
):I(i,void 0,function(e){return E(r,e)},function(e){return T(r,e)})):void 0!==n&&c(n)?H(e,t,n):L(e,t)}function E(t,e){if(t===e
)T(t,new TypeError("You cannot resolve a promise with itself"));else if(r=_typeof(n=e),null===n||"object"!==r&&"function"!==r)L(
t,e);else{n=void 0;try{n=e.then}catch(e){return void T(t,e)}S(t,e,n)}var n,r}function B(e){e._onerror&&e._onerror(e._result),k(e
)}function L(e,t){e._state===v&&(e._result=t,e._state=A,0!==e._subscribers.length&&a(k,e))}function T(e,t){e._state===v&&(
e._state=C,e._result=t,a(B,e))}function I(e,t,n,r){var i=e._subscribers,o=i.length;e._onerror=null,i[o]=t,i[o+A]=n,i[o+C]=r,
0===o&&e._state&&a(k,e)}function k(e){var t=e._subscribers,n=e._state;if(0!==t.length){for(var r,i=void 0,o=e._result,
a=0;a<t.length;a+=3)r=t[a],i=t[a+n],r?_(n,r,i,o):i(o);e._subscribers.length=0}}function _(e,t,n,r){var i=c(n),o=void 0,a=void 0,
s=!0;if(i){try{o=n(r)}catch(e){s=!1,a=e}if(t===o)return void T(t,new TypeError(
"A promises callback cannot return that same promise."))}else o=r;t._state===v&&(i&&s?E(t,o):!1===s?T(t,a):e===A?L(t,o
):e===C&&T(t,o))}var j=0;function x(e){e[m]=j++,e._state=void 0,e._result=void 0,e._subscribers=[]}
M.prototype._enumerate=function(e){for(var t=0;this._state===v&&t<e.length;t++)this._eachEntry(e[t],t)},
M.prototype._eachEntry=function(t,e){var n=this._instanceConstructor,r=n.resolve;if(r===y){var i,o=void 0,a=void 0,s=!1;try{
o=t.then}catch(e){s=!0,a=e}o===D&&t._state!==v?this._settledAt(t._state,e,t._result):"function"!=typeof o?(this._remaining--,
this._result[e]=t):n===U?(i=new n(w),s?T(i,a):S(i,t,o),this._willSettleAt(i,e)):this._willSettleAt(new n(function(e){return e(t)
}),e)}else this._willSettleAt(r(t),e)},M.prototype._settledAt=function(e,t,n){var r=this.promise;r._state===v&&(
this._remaining--,e===C?T(r,n):this._result[t]=n),0===this._remaining&&L(r,this._result)},M.prototype._willSettleAt=function(e,t
){var n=this;I(e,void 0,function(e){return n._settledAt(A,t,e)},function(e){return n._settledAt(C,t,e)})};var N=M;function M(e,t
){this._instanceConstructor=e,this.promise=new e(w),this.promise[m]||x(this.promise),n(t)?(this.length=t.length,
this._remaining=t.length,this._result=new Array(this.length),0!==this.length&&(this.length=this.length||0,this._enumerate(t),
0!==this._remaining)||L(this.promise,this._result)):T(this.promise,new Error("Array Methods must be provided an Array"))}
O.prototype.catch=function(e){return this.then(null,e)},O.prototype.finally=function(t){var n=this.constructor;return c(t
)?this.then(function(e){return n.resolve(t()).then(function(){return e})},function(e){return n.resolve(t()).then(function(){
throw e})}):this.then(t,t)};var U=O;function O(e){if(this[m]=j++,this._result=this._state=void 0,this._subscribers=[],w!==e){if(
"function"!=typeof e)throw new TypeError("You must pass a resolver function as the first argument to the promise constructor");
if(!(this instanceof O))throw new TypeError(
"Failed to construct 'Promise': Please use the 'new' operator, this object constructor cannot be called as a function.");
var t=this;try{e(function(e){E(t,e)},function(e){T(t,e)})}catch(e){T(t,e)}}}return U.prototype.then=D,U.all=function(e){
return new N(this,e).promise},U.race=function(i){var o=this;return n(i)?new o(function(e,t){for(var n=i.length,r=0;r<n;r++
)o.resolve(i[r]).then(e,t)}):new o(function(e,t){return t(new TypeError("You must pass an array to race."))})},U.resolve=y,
U.reject=function(e){var t=new this(w);return T(t,e),t},U._setScheduler=function(e){i=e},U._setAsap=function(e){a=e},U._asap=a,
U.polyfill=function(){var e=void 0;if(void 0!==R)e=R;else if("undefined"!=typeof self)e=self;else try{e=Function("return this")(
)}catch(e){throw new Error("polyfill failed because global object is unavailable in this environment")}var t=e.Promise;if(t){
var n=null;try{n=Object.prototype.toString.call(t.resolve())}catch(e){}if("[object Promise]"===n&&!t.cast)return}e.Promise=U},
U.Promise=U},"object"===_typeof(r)&&void 0!==n?n.exports=t():"function"==typeof define&&define.amd?define(t):e.ES6Promise=t()
}.call(this)}.call(this,F("_process"),
"undefined"!=typeof global?global:"undefined"!=typeof self?self:"undefined"!=typeof window?window:{})},{_process:35}],35:[
function(e,t,n){var r,i,t=t.exports={};function o(){throw new Error("setTimeout has not been defined")}function a(){
throw new Error("clearTimeout has not been defined")}try{r="function"==typeof setTimeout?setTimeout:o}catch(e){r=o}try{
i="function"==typeof clearTimeout?clearTimeout:a}catch(e){i=a}function s(t){if(r===setTimeout)return setTimeout(t,0);if((
r===o||!r)&&setTimeout)return(r=setTimeout)(t,0);try{return r(t,0)}catch(e){try{return r.call(null,t,0)}catch(e){return r.call(
this,t,0)}}}var c,u=[],d=!1,l=-1;function g(){d&&c&&(d=!1,c.length?u=c.concat(u):l=-1,u.length&&f())}function f(){if(!d){for(
var e=s(g),t=(d=!0,u.length);t;){for(c=u,u=[];++l<t;)c&&c[l].run();l=-1,t=u.length}c=null,d=!1,!function(t){if(i===clearTimeout
)return clearTimeout(t);if((i===a||!i)&&clearTimeout)return(i=clearTimeout)(t);try{i(t)}catch(e){try{return i.call(null,t)
}catch(e){return i.call(this,t)}}}(e)}}function p(e,t){this.fun=e,this.array=t}function h(){}t.nextTick=function(e){
var t=new Array(arguments.length-1);if(1<arguments.length)for(var n=1;n<arguments.length;n++)t[n-1]=arguments[n];u.push(new p(e,
t)),1!==u.length||d||s(f)},p.prototype.run=function(){this.fun.apply(null,this.array)},t.title="browser",t.browser=!0,t.env={},
t.argv=[],t.version="",t.versions={},t.on=h,t.addListener=h,t.once=h,t.off=h,t.removeListener=h,t.removeAllListeners=h,t.emit=h,
t.prependListener=h,t.prependOnceListener=h,t.listeners=function(e){return[]},t.binding=function(e){throw new Error(
"process.binding is not supported")},t.cwd=function(){return"/"},t.chdir=function(e){throw new Error(
"process.chdir is not supported")},t.umask=function(){return 0}},{}],36:[function(e,t,n){var r,i;r=this,i=function(s){var t,n,
c="undefined"!=typeof globalThis&&globalThis||"undefined"!=typeof self&&self||void 0!==c&&c,r="URLSearchParams"in c,
i="Symbol"in c&&"iterator"in Symbol,u="FileReader"in c&&"Blob"in c&&function(){try{return new Blob,!0}catch(e){return!1}}(),
o="FormData"in c,d="ArrayBuffer"in c;function a(e){if("string"!=typeof e&&(e=String(e)),/[^a-z0-9\-#$%&'*+.^_`|~!]/i.test(e
)||""===e)throw new TypeError('Invalid character in header field name: "'+e+'"');return e.toLowerCase()}function l(e){
return e="string"!=typeof e?String(e):e}function e(t){var e={next:function(){var e=t.shift();return{done:void 0===e,value:e}}};
return i&&(e[Symbol.iterator]=function(){return e}),e}function g(t){this.map={},t instanceof g?t.forEach(function(e,t){
this.append(t,e)},this):Array.isArray(t)?t.forEach(function(e){this.append(e[0],e[1])},this):t&&Object.getOwnPropertyNames(t
).forEach(function(e){this.append(e,t[e])},this)}function f(e){if(e.bodyUsed)return Promise.reject(new TypeError("Already read")
);e.bodyUsed=!0}function p(n){return new Promise(function(e,t){n.onload=function(){e(n.result)},n.onerror=function(){t(n.error)}
})}function h(e){var t=new FileReader,n=p(t);return t.readAsArrayBuffer(e),n}function b(e){var t;return e.slice?e.slice(0):((
t=new Uint8Array(e.byteLength)).set(new Uint8Array(e)),t.buffer)}function D(){return this.bodyUsed=!1,this._initBody=function(e
){var t;this.bodyUsed=this.bodyUsed,(this._bodyInit=e)?"string"==typeof e?this._bodyText=e:u&&Blob.prototype.isPrototypeOf(e
)?this._bodyBlob=e:o&&FormData.prototype.isPrototypeOf(e)?this._bodyFormData=e:r&&URLSearchParams.prototype.isPrototypeOf(e
)?this._bodyText=e.toString():d&&u&&((t=e)&&DataView.prototype.isPrototypeOf(t))?(this._bodyArrayBuffer=b(e.buffer),
this._bodyInit=new Blob([this._bodyArrayBuffer])):d&&(ArrayBuffer.prototype.isPrototypeOf(e)||n(e))?this._bodyArrayBuffer=b(e
):this._bodyText=e=Object.prototype.toString.call(e):this._bodyText="",this.headers.get("content-type")||(
"string"==typeof e?this.headers.set("content-type","text/plain;charset=UTF-8"
):this._bodyBlob&&this._bodyBlob.type?this.headers.set("content-type",this._bodyBlob.type
):r&&URLSearchParams.prototype.isPrototypeOf(e)&&this.headers.set("content-type",
"application/x-www-form-urlencoded;charset=UTF-8"))},u&&(this.blob=function(){var e=f(this);if(e)return e;if(this._bodyBlob
)return Promise.resolve(this._bodyBlob);if(this._bodyArrayBuffer)return Promise.resolve(new Blob([this._bodyArrayBuffer]));if(
this._bodyFormData)throw new Error("could not read FormData body as blob");return Promise.resolve(new Blob([this._bodyText]))},
this.arrayBuffer=function(){return this._bodyArrayBuffer?f(this)||(ArrayBuffer.isView(this._bodyArrayBuffer)?Promise.resolve(
this._bodyArrayBuffer.buffer.slice(this._bodyArrayBuffer.byteOffset,
this._bodyArrayBuffer.byteOffset+this._bodyArrayBuffer.byteLength)):Promise.resolve(this._bodyArrayBuffer)):this.blob().then(h)}
),this.text=function(){var e,t,n=f(this);if(n)return n;if(this._bodyBlob)return n=this._bodyBlob,e=new FileReader,t=p(e),
e.readAsText(n),t;if(this._bodyArrayBuffer)return Promise.resolve(function(e){for(var t=new Uint8Array(e),n=new Array(t.length),
r=0;r<t.length;r++)n[r]=String.fromCharCode(t[r]);return n.join("")}(this._bodyArrayBuffer));if(this._bodyFormData
)throw new Error("could not read FormData body as text");return Promise.resolve(this._bodyText)},o&&(this.formData=function(){
return this.text().then(w)}),this.json=function(){return this.text().then(JSON.parse)},this}d&&(t=["[object Int8Array]",
"[object Uint8Array]","[object Uint8ClampedArray]","[object Int16Array]","[object Uint16Array]","[object Int32Array]",
"[object Uint32Array]","[object Float32Array]","[object Float64Array]"],n=ArrayBuffer.isView||function(e){
return e&&-1<t.indexOf(Object.prototype.toString.call(e))}),g.prototype.append=function(e,t){e=a(e),t=l(t);var n=this.map[e];
this.map[e]=n?n+", "+t:t},g.prototype.delete=function(e){delete this.map[a(e)]},g.prototype.get=function(e){return e=a(e),
this.has(e)?this.map[e]:null},g.prototype.has=function(e){return this.map.hasOwnProperty(a(e))},g.prototype.set=function(e,t){
this.map[a(e)]=l(t)},g.prototype.forEach=function(e,t){for(var n in this.map)this.map.hasOwnProperty(n)&&e.call(t,this.map[n],n,
this)},g.prototype.keys=function(){var n=[];return this.forEach(function(e,t){n.push(t)}),e(n)},g.prototype.values=function(){
var t=[];return this.forEach(function(e){t.push(e)}),e(t)},g.prototype.entries=function(){var n=[];return this.forEach(function(
e,t){n.push([t,e])}),e(n)},i&&(g.prototype[Symbol.iterator]=g.prototype.entries);var y=["DELETE","GET","HEAD","OPTIONS","POST",
"PUT"];function m(e,t){if(!(this instanceof m))throw new TypeError(
'Please use the "new" operator, this DOM object constructor cannot be called as a function.');var n,r=(t=t||{}).body;if(
e instanceof m){if(e.bodyUsed)throw new TypeError("Already read");this.url=e.url,this.credentials=e.credentials,t.headers||(
this.headers=new g(e.headers)),this.method=e.method,this.mode=e.mode,this.signal=e.signal,r||null==e._bodyInit||(r=e._bodyInit,
e.bodyUsed=!0)}else this.url=String(e);if(this.credentials=t.credentials||this.credentials||"same-origin",
!t.headers&&this.headers||(this.headers=new g(t.headers)),this.method=(e=t.method||this.method||"GET",n=e.toUpperCase(),
-1<y.indexOf(n)?n:e),this.mode=t.mode||this.mode||null,this.signal=t.signal||this.signal,this.referrer=null,(
"GET"===this.method||"HEAD"===this.method)&&r)throw new TypeError("Body not allowed for GET or HEAD requests");this._initBody(r)
,"GET"!==this.method&&"HEAD"!==this.method||"no-store"!==t.cache&&"no-cache"!==t.cache||((n=/([?&])_=[^&]*/).test(this.url
)?this.url=this.url.replace(n,"$1_="+(new Date).getTime()):this.url+=(/\?/.test(this.url)?"&":"?")+"_="+(new Date).getTime())}
function w(e){var n=new FormData;return e.trim().split("&").forEach(function(e){var t;e&&(t=(e=e.split("=")).shift().replace(
/\+/g," "),e=e.join("=").replace(/\+/g," "),n.append(decodeURIComponent(t),decodeURIComponent(e)))}),n}function v(e,t){if(!(
this instanceof v))throw new TypeError(
'Please use the "new" operator, this DOM object constructor cannot be called as a function.');t=t||{},this.type="default",
this.status=void 0===t.status?200:t.status,this.ok=200<=this.status&&this.status<300,
this.statusText=void 0===t.statusText?"":""+t.statusText,this.headers=new g(t.headers),this.url=t.url||"",this._initBody(e)}
m.prototype.clone=function(){return new m(this,{body:this._bodyInit})},D.call(m.prototype),D.call(v.prototype),
v.prototype.clone=function(){return new v(this._bodyInit,{status:this.status,statusText:this.statusText,headers:new g(
this.headers),url:this.url})},v.error=function(){var e=new v(null,{status:0,statusText:""});return e.type="error",e};var A=[301,
302,303,307,308];v.redirect=function(e,t){if(-1===A.indexOf(t))throw new RangeError("Invalid status code");return new v(null,{
status:t,headers:{location:e}})},s.DOMException=c.DOMException;try{new s.DOMException}catch(e){s.DOMException=function(e,t){
this.message=e,this.name=t;t=Error(e);this.stack=t.stack},s.DOMException.prototype=Object.create(Error.prototype),
s.DOMException.prototype.constructor=s.DOMException}function C(r,a){return new Promise(function(i,e){var t=new m(r,a);if(
t.signal&&t.signal.aborted)return e(new s.DOMException("Aborted","AbortError"));var o=new XMLHttpRequest;function n(){o.abort()}
o.onload=function(){var e,n,t={status:o.status,statusText:o.statusText,headers:(e=o.getAllResponseHeaders()||"",n=new g,
e.replace(/\r?\n[\t ]+/g," ").split("\r").map(function(e){return 0===e.indexOf("\n")?e.substr(1,e.length):e}).forEach(function(e
){var e=e.split(":"),t=e.shift().trim();t&&(e=e.join(":").trim(),n.append(t,e))}),n)},r=(
t.url="responseURL"in o?o.responseURL:t.headers.get("X-Request-URL"),"response"in o?o.response:o.responseText);setTimeout(
function(){i(new v(r,t))},0)},o.onerror=function(){setTimeout(function(){e(new TypeError("Network request failed"))},0)},
o.ontimeout=function(){setTimeout(function(){e(new TypeError("Network request failed"))},0)},o.onabort=function(){setTimeout(
function(){e(new s.DOMException("Aborted","AbortError"))},0)},o.open(t.method,function(t){try{
return""===t&&c.location.href?c.location.href:t}catch(e){return t}}(t.url),!0),
"include"===t.credentials?o.withCredentials=!0:"omit"===t.credentials&&(o.withCredentials=!1),"responseType"in o&&(
u?o.responseType="blob":d&&t.headers.get("Content-Type")&&-1!==t.headers.get("Content-Type").indexOf("application/octet-stream"
)&&(o.responseType="arraybuffer")),!a||"object"!==_typeof(a.headers)||a.headers instanceof g?t.headers.forEach(function(e,t){
o.setRequestHeader(t,e)}):Object.getOwnPropertyNames(a.headers).forEach(function(e){o.setRequestHeader(e,l(a.headers[e]))}),
t.signal&&(t.signal.addEventListener("abort",n),o.onreadystatechange=function(){4===o.readyState&&t.signal.removeEventListener(
"abort",n)}),o.send(void 0===t._bodyInit?null:t._bodyInit)})}C.polyfill=!0,c.fetch||(c.fetch=C,c.Headers=g,c.Request=m,
c.Response=v),s.Headers=g,s.Request=m,s.Response=v,s.fetch=C,Object.defineProperty(s,"__esModule",{value:!0})},
"object"===_typeof(n)&&void 0!==t?i(n):"function"==typeof define&&define.amd?define(["exports"],i):i(r.WHATWGFetch={})},{}],37:[
function(e,t,n){e("es6-promise").polyfill(),e("whatwg-fetch");var r={Accordion:e("ddc-accordion"),Ads:e("ddc-ads"),Analytics:e(
"ddc-analytics"),Api:e("ddc-api"),Config:e("ddc-config"),Cookie:e("ddc-cookie"),Debug:e("ddc-debug"),Drug:e("ddc-drug"),Error:e(
"ddc-error"),Fixable:e("ddc-fixable"),Helper:e("ddc-helper"),Image:e("ddc-image"),Intersection:e("ddc-intersection"),List:e(
"ddc-list"),Load:e("ddc-load"),Log:e("ddc-log"),Menu:e("ddc-menu"),Modal:e("ddc-modal"),NativeApp:e("ddc-native-app"),Page:e(
"ddc-page"),Search:e("ddc-search"),Share:e("ddc-share"),Toast:e("ddc-toast"),User:e("ddc-user"),Utils:e("ddc-utils")};
function i(){r.Load.init().then(function(){r.Ads.Display.init(),r.Ads.Injection.init(),r.Fixable.init()}),r.Accordion.init(),
r.Analytics.init(),r.Drug.init(),r.Image.init(),r.List.init(),r.Log.init(),r.Menu.init(),r.Modal.init(),r.Page.init(),
r.Search.init(),r.Share.init(),r.Toast.init(),r.User.init(),r.NativeApp.init()}window.DDC=window.DDC||{},window.DDC.Ads=r.Ads,
window.DDC.Analytics=r.Analytics,window.DDC.Api=r.Api,window.DDC.Config=r.Config,window.DDC.Cookie=r.Cookie,
window.DDC.Debug=r.Debug,window.DDC.Helper=r.Helper,window.DDC.Intersection=r.Intersection,window.DDC.Modal=r.Modal,
window.DDC.Page=r.Page,window.DDC.User=r.User,window.DDC.Utils=r.Utils,r.Debug.init();var o,e=[];window.polyfillLoaded||e.push((
o="/bundle/js/polyfill.min.js",new Promise(function(e,t){var n=document.createElement("script");
n.onload=n.onreadystatechange=function(){n.readyState&&"loaded"!==n.readyState&&"complete"!==n.readyState||(
n.onreadystatechange=null,e())},n.onerror=function(){t("Failed to load script: "+o)},n.src=o,document.body.appendChild(n)}))),
e.length?Promise.all(e).then(i).catch(function(e){}):i()},{"ddc-accordion":1,"ddc-ads":5,"ddc-analytics":9,"ddc-api":10,
"ddc-config":11,"ddc-cookie":12,"ddc-debug":13,"ddc-drug":14,"ddc-error":16,"ddc-fixable":17,"ddc-helper":18,"ddc-image":20,
"ddc-intersection":21,"ddc-list":22,"ddc-load":23,"ddc-log":24,"ddc-menu":25,"ddc-modal":26,"ddc-native-app":27,"ddc-page":28,
"ddc-search":29,"ddc-share":30,"ddc-toast":31,"ddc-user":32,"ddc-utils":33,"es6-promise":34,"whatwg-fetch":36}]},{},[37]);