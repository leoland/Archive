console.log("feather"),function($){"use strict";function e(t,n){if(!(this instanceof e)){var r=new e(t,n);return r.open(),r}this.id=e.id++,this.setup(t,n),this.chainCallbacks(e._callbackChain)}function t(e,t){var n={};for(var r in e)r in t&&(n[r]=e[r],delete e[r]);return n}function n(e,t){var n={},r=new RegExp("^"+t+"([A-Z])(.*)");for(var i in e){var o=i.match(r);if(o){n[(o[1]+o[2].replace(/([A-Z])/g,"-$1")).toLowerCase()]=e[i]}}return n}if(void 0===$)return void("console"in window&&window.console.info("Too much lightness, Featherlight needs jQuery."));if($.fn.jquery.match(/-ajax/))return void("console"in window&&window.console.info("Featherlight needs regular jQuery, not the slim version."));var r=[],i=function(e){return r=$.grep(r,function(t){return t!==e&&t.$instance.closest("body").length>0})},o={allow:1,allowfullscreen:1,frameborder:1,height:1,longdesc:1,marginheight:1,marginwidth:1,mozallowfullscreen:1,name:1,referrerpolicy:1,sandbox:1,scrolling:1,src:1,srcdoc:1,style:1,webkitallowfullscreen:1,width:1},a={keyup:"onKeyUp",resize:"onResize"},s=function(t){$.each(e.opened().reverse(),function(){if(!t.isDefaultPrevented()&&!1===this[a[t.type]](t))return t.preventDefault(),t.stopPropagation(),!1})},c=function(t){if(t!==e._globalHandlerInstalled){e._globalHandlerInstalled=t;var n=$.map(a,function(t,n){return n+"."+e.prototype.namespace}).join(" ");$(window)[t?"on":"off"](n,s)}};e.prototype={constructor:e,namespace:"featherlight",targetAttr:"data-featherlight",variant:null,resetCss:!1,background:null,openTrigger:"click",closeTrigger:"click",filter:null,root:"body",openSpeed:250,closeSpeed:250,closeOnClick:"background",closeOnEsc:!0,closeIcon:"&#10005;",loading:"",persist:!1,otherClose:null,beforeOpen:$.noop,beforeContent:$.noop,beforeClose:$.noop,afterOpen:$.noop,afterContent:$.noop,afterClose:$.noop,onKeyUp:$.noop,onResize:$.noop,type:null,contentFilters:["jquery","image","html","ajax","iframe","text"],setup:function(e,t){"object"!=typeof e||e instanceof $!=!1||t||(t=e,e=void 0);var n=$.extend(this,t,{target:e}),r=n.resetCss?n.namespace+"-reset":n.namespace,i=$(n.background||['<div class="'+r+"-loading "+r+'">','<div class="'+r+'-content">','<button class="'+r+"-close-icon "+n.namespace+'-close" aria-label="Close">',n.closeIcon,"</button>",'<div class="'+n.namespace+'-inner">'+n.loading+"</div>","</div>","</div>"].join("")),o="."+n.namespace+"-close"+(n.otherClose?","+n.otherClose:"");return n.$instance=i.clone().addClass(n.variant),n.$instance.on(n.closeTrigger+"."+n.namespace,function(e){if(!e.isDefaultPrevented()){var t=$(e.target);("background"===n.closeOnClick&&t.is("."+n.namespace)||"anywhere"===n.closeOnClick||t.closest(o).length)&&(n.close(e),e.preventDefault())}}),this},getContent:function(){if(!1!==this.persist&&this.$content)return this.$content;var e=this,t=this.constructor.contentFilters,n=function(t){return e.$currentTarget&&e.$currentTarget.attr(t)},r=n(e.targetAttr),i=e.target||r||"",o=t[e.type];if(!o&&i in t&&(o=t[i],i=e.target&&r),i=i||n("href")||"",!o)for(var a in t)e[a]&&(o=t[a],i=e[a]);if(!o){var s=i;if(i=null,$.each(e.contentFilters,function(){return o=t[this],o.test&&(i=o.test(s)),!i&&o.regex&&s.match&&s.match(o.regex)&&(i=s),!i}),!i)return"console"in window&&window.console.error("Featherlight: no content filter found "+(s?' for "'+s+'"':" (no target specified)")),!1}return o.process.call(e,i)},setContent:function(e){return this.$instance.removeClass(this.namespace+"-loading"),this.$instance.toggleClass(this.namespace+"-iframe",e.is("iframe")),this.$instance.find("."+this.namespace+"-inner").not(e).slice(1).remove().end().replaceWith($.contains(this.$instance[0],e[0])?"":e),this.$content=e.addClass(this.namespace+"-inner"),this},open:function(e){var t=this;if(t.$instance.hide().appendTo(t.root),!(e&&e.isDefaultPrevented()||!1===t.beforeOpen(e))){e&&e.preventDefault();var n=t.getContent();if(n)return r.push(t),c(!0),t.$instance.fadeIn(t.openSpeed),t.beforeContent(e),$.when(n).always(function(n){t.setContent(n),t.afterContent(e)}).then(t.$instance.promise()).done(function(){t.afterOpen(e)})}return t.$instance.detach(),$.Deferred().reject().promise()},close:function(e){var t=this,n=$.Deferred();return!1===t.beforeClose(e)?n.reject():(0===i(t).length&&c(!1),t.$instance.fadeOut(t.closeSpeed,function(){t.$instance.detach(),t.afterClose(e),n.resolve()})),n.promise()},resize:function(e,t){if(e&&t){this.$content.css("width","").css("height","");var n=Math.max(e/(this.$content.parent().width()-1),t/(this.$content.parent().height()-1));n>1&&(n=t/Math.floor(t/n),this.$content.css("width",e/n+"px").css("height",t/n+"px"))}},chainCallbacks:function(e){for(var t in e)this[t]=$.proxy(e[t],this,$.proxy(this[t],this))}},$.extend(e,{id:0,autoBind:"[data-featherlight]",defaults:e.prototype,contentFilters:{jquery:{regex:/^[#.]\w/,test:function(e){return e instanceof $&&e},process:function(e){return!1!==this.persist?$(e):$(e).clone(!0)}},image:{regex:/\.(png|jpg|jpeg|gif|tiff?|bmp|svg)(\?\S*)?$/i,process:function(e){var t=this,n=$.Deferred(),r=new Image,i=$('<img src="'+e+'" alt="" class="'+t.namespace+'-image" />');return r.onload=function(){i.naturalWidth=r.width,i.naturalHeight=r.height,n.resolve(i)},r.onerror=function(){n.reject(i)},r.src=e,n.promise()}},html:{regex:/^\s*<[\w!][^<]*>/,process:function(e){return $(e)}},ajax:{regex:/./,process:function(e){var t=this,n=$.Deferred(),r=$("<div></div>").load(e,function(e,t){"error"!==t&&n.resolve(r.contents()),n.fail()});return n.promise()}},iframe:{process:function(e){var r=new $.Deferred,i=$("<iframe/>"),a=n(this,"iframe"),s=t(a,o);return i.hide().attr("src",e).attr(s).css(a).on("load",function(){r.resolve(i.show())}).appendTo(this.$instance.find("."+this.namespace+"-content")),r.promise()}},text:{process:function(e){return $("<div>",{text:e})}}},functionAttributes:["beforeOpen","afterOpen","beforeContent","afterContent","beforeClose","afterClose"],readElementConfig:function(e,t){var n=this,r=new RegExp("^data-"+t+"-(.*)"),i={};return e&&e.attributes&&$.each(e.attributes,function(){var e=this.name.match(r);if(e){var t=this.value,o=$.camelCase(e[1]);if($.inArray(o,n.functionAttributes)>=0)t=new Function(t);else try{t=JSON.parse(t)}catch(e){}i[o]=t}}),i},extend:function(e,t){var n=function(){this.constructor=e};return n.prototype=this.prototype,e.prototype=new n,e.__super__=this.prototype,$.extend(e,this,t),e.defaults=e.prototype,e},attach:function(e,t,n){var r=this;"object"!=typeof t||t instanceof $!=!1||n||(n=t,t=void 0),n=$.extend({},n);var i=n.namespace||r.defaults.namespace,o=$.extend({},r.defaults,r.readElementConfig(e[0],i),n),a,s=function(i){var s=$(i.currentTarget),c=$.extend({$source:e,$currentTarget:s},r.readElementConfig(e[0],o.namespace),r.readElementConfig(i.currentTarget,o.namespace),n),l=a||s.data("featherlight-persisted")||new r(t,c);"shared"===l.persist?a=l:!1!==l.persist&&s.data("featherlight-persisted",l),c.$currentTarget.blur&&c.$currentTarget.blur(),l.open(i)};return e.on(o.openTrigger+"."+o.namespace,o.filter,s),{filter:o.filter,handler:s}},current:function(){var e=this.opened();return e[e.length-1]||null},opened:function(){var e=this;return i(),$.grep(r,function(t){return t instanceof e})},close:function(e){var t=this.current();if(t)return t.close(e)},_onReady:function(){var e=this;if(e.autoBind){var t=$(e.autoBind);t.each(function(){e.attach($(this))}),$(document).on("click",e.autoBind,function(n){if(!n.isDefaultPrevented()){var r=$(n.currentTarget),i=t.length;if(t=t.add(r),i!==t.length){var o=e.attach(r);(!o.filter||$(n.target).parentsUntil(r,o.filter).length>0)&&o.handler(n)}}})}},_callbackChain:{onKeyUp:function(e,t){return 27===t.keyCode?(this.closeOnEsc&&$.featherlight.close(t),!1):e(t)},beforeOpen:function(e,t){return $(document.documentElement).addClass("with-featherlight"),this._previouslyActive=document.activeElement,this._$previouslyTabbable=$("a, input, select, textarea, iframe, button, iframe, [contentEditable=true]").not("[tabindex]").not(this.$instance.find("button")),this._$previouslyWithTabIndex=$("[tabindex]").not('[tabindex="-1"]'),this._previousWithTabIndices=this._$previouslyWithTabIndex.map(function(e,t){return $(t).attr("tabindex")}),this._$previouslyWithTabIndex.add(this._$previouslyTabbable).attr("tabindex",-1),document.activeElement.blur&&document.activeElement.blur(),e(t)},afterClose:function(t,n){var r=t(n),i=this;return this._$previouslyTabbable.removeAttr("tabindex"),this._$previouslyWithTabIndex.each(function(e,t){$(t).attr("tabindex",i._previousWithTabIndices[e])}),this._previouslyActive.focus(),0===e.opened().length&&$(document.documentElement).removeClass("with-featherlight"),r},onResize:function(e,t){return this.resize(this.$content.naturalWidth,this.$content.naturalHeight),e(t)},afterContent:function(e,t){var n=e(t);return this.$instance.find("[autofocus]:not([disabled])").focus(),this.onResize(t),n}}}),$.featherlight=e,$.fn.featherlight=function(t,n){return e.attach(this,t,n),this},$(document).ready(function(){e._onReady()})}(jQuery);