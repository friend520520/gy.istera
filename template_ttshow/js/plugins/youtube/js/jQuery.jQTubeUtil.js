;jQTubeUtil=(function($){var f=function(){};var p=f.prototype;var SuggestURL="https://suggestqueries.google.com/complete/search";var CoreDefaults={"callback":"?"};var SuggestDefaults={hl:"en",ds:"yt",client:"youtube",hjson:"t",cp:1};p.init=function(options){if(options.lang)
SuggestDefaults.hl=options.lang;};p.suggest=function(input,callback){var opts={q:encodeURIComponent(input)};var url=_buildURL(SuggestURL,$.extend({},SuggestDefaults,opts));$.ajax({type:"GET",dataType:"json",url:url,success:function(xhr){var suggestions=[],res={};for(entry in xhr[1]){suggestions.push(xhr[1][entry][0]);}
res.suggestions=suggestions;res.searchURL=url;if(typeof(callback)=="function"){callback(res);return;}}});};function _buildURL(root,options){var ret="?",k,v,first=true;var opts=$.extend({},options,CoreDefaults);for(o in opts){k=o;v=opts[o];ret+=(first?"":"&")+k+"="+v;first=false;}
return root+ret;};return new f();})(jQuery);