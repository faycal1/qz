// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeline', 'timelineEnd', 'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.
$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    /*
     Allows you to add data-method="METHOD to links to automatically inject a form with the method on click
     Example: <a href="{{route('customers.destroy', $customer->id)}}" data-method="delete" name="delete_item">Delete</a>
     Injects a form with that's fired on click of the link with a DELETE request.
     Good because you don't have to dirty your HTML with delete forms everywhere.
     */
    $('[data-method]').append(function(){
        return "\n"+
        "<form action='"+$(this).attr('href')+"' method='POST' name='delete_item' style='display:none'>\n"+
        "   <input type='hidden' name='_method' value='"+$(this).attr('data-method')+"'>\n"+
        "   <input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'>\n"+
        "</form>\n"
    })
        .removeAttr('href')
        .attr('style','cursor:pointer;')
        .attr('onclick','$(this).find("form").submit();');

    /*
     Generic are you sure dialog
     */
    $('form[name=delete_item]').submit(function(e){

         e.preventDefault();
         var _this = $(this);
        swal({
          title: "Are you sure?",
          text: "You will not be able to recover this imaginary file!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false
        },
        function(){
            _this.unbind('submit').submit();
            swal("Deleted!", "...", "success");
          
        });

       // return confirm("Are you sure you want to delete this item?");
    });

    // $('form[name=delete_item_user]').submit(function(e){

    //      e.preventDefault();
    //      var linkURL = 'admin/access/users';
    //     swal({
    //       title: "Are you sure?",
    //       text: "You will not be able to recover this imaginary file!",
    //       type: "warning",
    //       showCancelButton: true,
    //       confirmButtonColor: "#DD6B55",
    //       confirmButtonText: "Yes, delete it!",
    //       closeOnConfirm: false
    //     },
    //     function(){
    //         window.location.href = linkURL;
    //         swal("Deleted!", "...", "success");
          
    //     });

    //    // return confirm("Are you sure you want to delete this item?");
    // });

    /*
     Bind all bootstrap tooltips
     */
    $("[data-toggle=\"tooltip\"]").tooltip();
    $("[data-toggle=\"popover\"]").popover();
    //This closes the popover when its clicked away from
    $('body').on('click', function (e) {
        $('[data-toggle="popover"]').each(function () {
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
});
$(function(){

});
/**
 * VERSION: 2.1
 * DATE: 
 * JS
 * AUTHOR: Ian Duff
 * COPYRIGHT: Essemble Ltd
 * All code © 2015 Essemble Ltd. all rights reserved
 * This code is the property of Essemble Ltd and cannot be copied, reused or modified without prior permission
 **/
 function extend(t,e){var i=e.prototype;e.prototype=Object.create(t.prototype);for(var n in i)e.prototype[n]=i[n];e.prototype.constructor=e,Object.defineProperty(e.prototype,"constructor",{enumerable:!1,value:e})}function get(t){return document.getElementById(t)}function getJQ(t){return $("#"+t)}function loadXML(t,e){$.ajax({type:"GET",url:t,dataType:"xml",error:xmlError,success:e})}function xmlError(t,e){alert("xmlError "+e)}function checkColour(t){var e=null;switch(t){case"":break;default:if(-1!=t.indexOf("rgb"))e=t;else{var e=t.replace("0x","");"#"!=e.charAt(0)&&(e="#"+e)}}return e}function xmlAttr(t,e){var i=!1;return i=t.attr(e)?!0:!1}function xmlAttrNum(t,e){var i=!1;if(xmlAttr(t,e)){var n=t.attr(e);i=isNaN(parseInt(n))?!1:!0}return i}function xmlAttrStr(t,e){var i=!1;if(xmlAttr(t,e)){var n=t.attr(e);""!=n?i=!0:!1}return i}function create(t){var e=document.createElement(t.type);return t.id&&(e.id=t.id),t.className&&(e.className=t.className),t.imgSrc&&(e.src=t.imgSrc),t.href&&(e.href=t.href),t.inputType&&(e.type=t.inputType),t.inputValue&&(e.value=t.inputValue),t.title&&(e.title=t.title,e.alt=t.title),t.onMouseOver&&(e.onmouseover=t.onMouseOver),t.onMouseOut&&(e.onmouseout=t.onMouseOut),t.onMouseDown&&(e.onmousedown=t.onMouseDown),t.onFocus&&(e.onfocus=t.onFocus),t.onBlur&&(e.onblur=t.onBlur),t.onClick&&(e.onclick=t.onClick),t.tabIndex&&(e.tabIndex=t.tabIndex),t.accessKey&&(e.accessKey=t.accessKey),t.innerHTML&&(e.innerHTML=t.innerHTML),e}function hexToR(t){return parseInt(cutHex(t).substring(0,2),16)}function hexToG(t){return parseInt(cutHex(t).substring(2,4),16)}function hexToB(t){return parseInt(cutHex(t).substring(4,6),16)}function cutHex(t){var e=t;return"#"==t.charAt(0)&&(e=t.substring(1,7)),-1!=t.indexOf("0x")&&(e=t.substring(2,8)),e}function hexToRgb(t){var e=/^#?([a-f\d])([a-f\d])([a-f\d])$/i;t=t.replace(e,function(t,e,i,n){return e+e+i+i+n+n});var i=/^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(t);return i?{r:parseInt(i[1],16),g:parseInt(i[2],16),b:parseInt(i[3],16)}:null}function supportsRGBA(){var t=!1,e=document.createElement("div");return e.style.cssText="background-color:rgba(150,255,150,.5)",~(""+e.style.backgroundColor).indexOf("rgba")&&(t=!0),t}function replaceXMLStr(t,e,i){e=e.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&");var n=new RegExp(e,"g"),s=$(t).text().replace(n,i);return $(t).text(s),t}function JQEase(t){t||(t="easeOutQuad");var e=t;if(t.indexOf(".")>-1){var i=t.split("."),n=i[0],s=i[1];"Regular"==n&&(n="Quad"),e=s+n}return e}function getUnit(t){return-1==t.indexOf("%")&&-1==t.indexOf("px")&&-1==t.indexOf("em")&&(t+="px"),t}function Screen(t){this._container,this._id=t.id,this._xmlPath=t.xmlPath,this._arEvents=[],this._screenElement=null,this._elementLoader=null,t.screenElement&&(this._screenElement=t.screenElement),xmlAttrStr($(t.screenXML),"xml")&&(this._xmlPath=$(t.screenXML).attr("xml"),-1==this._xmlPath.indexOf(".xml")&&(this._xmlPath+=".xml")),this.loadXMLCompleteHandler=function(t){this._xml=$(t),this.createElements($(t)),this.doClickEventById("screenloading",null)}}function PxLoaderImage(t,e,i){var n=this,s=null;this.img=new Image,this.tags=e,this.priority=i;var r=function(){"complete"===n.img.readyState&&(l(),s.onLoad(n))},a=function(){l(),s.onLoad(n)},o=function(){l(),s.onError(n)},l=function(){n.unbind("load",a),n.unbind("readystatechange",r),n.unbind("error",o)};this.start=function(e){s=e,n.bind("load",a),n.bind("readystatechange",r),n.bind("error",o),n.img.src=t},this.checkStatus=function(){n.img.complete&&(l(),s.onLoad(n))},this.onTimeout=function(){l(),n.img.complete?s.onLoad(n):s.onTimeout(n)},this.getName=function(){return t},this.bind=function(t,e){n.img.addEventListener?n.img.addEventListener(t,e,!1):n.img.attachEvent&&n.img.attachEvent("on"+t,e)},this.unbind=function(t,e){n.img.removeEventListener?n.img.removeEventListener(t,e,!1):n.img.detachEvent&&n.img.detachEvent("on"+t,e)}}function Box(t){if(this._element=t.element,this._screen=t.element._screen,this._container=t.container,this._xml=t.xml,this._width=0,this._height=0,this._scroll=!1,this._element._width&&(this._width=this._element._width),this._element._height&&(this._height=this._element._height),xmlAttr(this._xml,"scroll")&&(this._scroll=Boolean(-1!=this._xml.attr("scroll").toLowerCase().indexOf("true"))),this._xml.children().length>0)for(var e=0;e<this._xml.children().length;e++){var i=this._xml.children()[e],n=t.element._elementLoader,s=new Element({screen:this._screen,xml:i});xmlAttr($(i),"target")||(s._target=this._container),n.addElement(s)}}function Button(t){this._screen=t.element._screen,this._container=t.container,this._xml=t.xml,this._xpad=10,this._ypad=6;var e=create({type:"input",inputType:"button",id:"btn",inputValue:$(this._xml).text().replace(/<[^>]*>/g,"")});this._container.appendChild(e),$(e).css("width","auto"),$(e).css("height","auto"),xmlAttrNum(this._xml,"width")&&$(e).css("width",this._xml.attr("width")),xmlAttrNum(this._xml,"height")&&$(e).css("height",this._xml.attr("height"))}function Element(t){this._screen=t.screen,this._xml=$(t.xml),this._type=t.xml.tagName||"sprite",this._elementLoader=t.loader||this._screen._elementLoader,this._id=this._xml.attr("id")||t.id||this.createInstanceName(),this._relativePos=!1,this._x=0,this._y=0,this._width=null,this._height=null,this._target=null,this._container=null,this._scroll=!1,this._anim="none",this._animease="Regular.easeOut",this._animtime=.5,this._animdelay=0,this._animOnComplete,this._eventq=!0,this._event=null,this._arRollovers=[],this._arRollouts=[],this._arClicks=[],this._custom=null,this._initialAnimComplete=!1,this._elementScreen=null,xmlAttrStr(this._xml,"x")&&(this._x=this._xml.attr("x")),xmlAttrStr(this._xml,"y")&&(this._y=this._xml.attr("y")),t.x&&(this._x=t.x),t.y&&(this._y=t.y),xmlAttrStr(this._xml,"width")&&(this._width=this._xml.attr("width")),xmlAttrStr(this._xml,"height")&&(this._height=this._xml.attr("height")),t.width&&(this._width=t.width),t.height&&(this._height=t.height),this._filter=this._xml.attr("filter")||null,xmlAttrStr(this._xml,"scroll")&&(this._scroll=Boolean(-1!=this._xml.attr("scroll").toLowerCase().indexOf("true"))),xmlAttrStr(this._xml,"anim")&&(this._anim=this._xml.attr("anim").toLowerCase()),xmlAttrNum(this._xml,"animrotate")&&(this._animrotate=this._xml.attr("animrotate")),xmlAttrStr(this._xml,"ease")&&(this._animease=this._xml.attr("ease")),xmlAttrNum(this._xml,"animtime")&&(this._animtime=parseFloat(this._xml.attr("animtime"))),xmlAttrNum(this._xml,"animdelay")&&(this._animdelay=parseFloat(this._xml.attr("animdelay"))),xmlAttrStr(this._xml,"animcomplete")&&(this._animOnComplete=this._xml.attr("animcomplete")),xmlAttrStr(this._xml,"event")&&(this._event=this._xml.attr("event")),xmlAttrStr(this._xml,"eventq")&&(this._eventq=Boolean("false"!=this._xml.attr("eventq").toLowerCase()))}function ElementLoader(t){var e=this;this._screen=t.screen,this._arElements=t.elements||[],this._onLoadComplete=t.onLoadComplete||null,this._onAnimsComplete=t.onAnimsComplete||null,this._onCompleteScope=t.onCompleteScope||this._screen,this._onCompleteParams=t.onCompleteParams||null,this._preloader=null,this._loadQueue,this._batchFinished=!1,this._loader=new PxLoader;for(var i=0;i<this._arElements.length;i++)this._arElements[i]._elementLoader=this;this._loader.addProgressListener(function(t){var e=new Image;e.src=t.resource.getName();var i=t.resource.element;xmlAttrStr(i._xml,"className")&&$(e).addClass(i._xml.attr("className")),xmlAttrStr(i._xml,"class")&&$(e).addClass(i._xml.attr("class")),$(i._container).append(e)}),this._loader.addCompletionListener(function(){e.hidePreloader(),e._onLoadComplete&&(e._onCompleteParams?e._onCompleteScope[e._onLoadComplete](e._onCompleteParams):e._onCompleteScope[e._onLoadComplete]());for(var t=0;t<e._arElements.length;t++)e._arElements[t]._relativePos?e.delayRelativePos(e._arElements[t]):e.delayAnimate(e._arElements[t])})}function Text(t){this._element=t.element,this._screen=this._element._screen,this._container=t.container,this._xml=t.xml,$(this._container).append(this._xml.text())}var supportsTouch="ontouchstart"in window||navigator.msMaxTouchPoints,bRGBASupported=supportsRGBA(),ua=navigator.userAgent.toLowerCase(),isiPad=null!=ua.match(/ipad/i),isiPhone=null!=ua.match(/iphone/i),isChrome=null!=ua.match(/chrome/i);null!==ua.match(/android 2\.[12]/)&&(HTMLMediaElement.prototype.canPlayType=function(t){return null!==t.match(/video\/(mp4|m4v)/gi)?"maybe":""}),Screen.prototype={load:function(t,e){this._elementLoader&&(this._elementLoader._arElements=null,this._elementLoader=null),this._container=t,e||this.unload(this._container),this._arEvents=[],this._xmlPath?loadXML(this._xmlPath,this.loadXMLCompleteHandler.bind(this)):alert("xml file has not been defined")},screenIsElement:function(){var t=!1;return this._screenElement&&(t=!0),t},createElements:function(t){var e;this._elementLoader=new ElementLoader(this.screenIsElement()?{screen:this,elements:[],onAnimsComplete:"screenAnimsComplete",onCompleteParams:[],onCompleteScope:this}:{screen:this,elements:[],onLoadComplete:"screenLoadComplete",onAnimsComplete:"screenAnimsComplete",onCompleteParams:[],onCompleteScope:this});var i=this;$(t).find("data").children().each(function(){switch(this.tagName.toLowerCase()){case"events":i.createEvents(this);break;default:e=new Element({screen:i,xml:this}),i.getElementLoaderArray().push(e)}}),this._elementLoader.load()},createEvents:function(t){var e=this;$(t).find("event").each(function(){var t=$(this).attr("id"),i=[],n=[],s=[];$(this).find("rollover").children().each(function(){i.push($(this))}),$(this).find("rollout").children().each(function(){n.push($(this))}),$(this).find("click").children().each(function(){s.push($(this))});var r={};r._id=t,r._arRollovers=i,r._arRollouts=n,r._arClicks=s,e._arEvents.push(r)})},screenLoadComplete:function(){},screenAnimsComplete:function(){this.doClickEventById("screenloaded",null)},container:function(){return this._container},unload:function(t){t.innerHTML="",this._elementLoader&&this._elementLoader.stop()},hide:function(){$(this._container).hide()},show:function(){$(this._container).show()},getElementLoaderArray:function(){return this._elementLoader.getElements()},getElementById:function(t){for(var e=null,i=this.getElementLoaderArray(),n=0;n<i.length;n++)if(i[n]._id==t){e=i[n];break}return e},getElementByType:function(t){for(var e=null,i=this.getElementLoaderArray(),n=0;n<i.length;n++)if(i[n]._type==t){e=i[n];break}return e},doClickEventById:function(t,e){for(var i=t.split(","),n=0;n<i.length;n++){var t=i[n],s=this.getScreen(t),r=this.getElementId(t),a=s.getEventById(r);a&&a._arClicks.length>0&&s.fireEvents(a._arClicks,e)}},getEventById:function(t){for(var e=null,i=0;i<this._arEvents.length;i++)if(this._arEvents[i]._id==t){e=this._arEvents[i];break}return e},getScreen:function(t){var e=this;return-1!=t.indexOf("parent.")&&(e=this._screenElement._screen),-1!=t.indexOf("screen.")&&(e=this._course.curScreen()),e},getElementId:function(t){var e=t;return-1!=t.indexOf(".")&&(e=t.split(".")[1]),e},fireEvents:function(t,e){for(var i=0;i<t.length;i++){var n,s,r=$(t[i]),a=r.text().replace(/\s+/g,"").toString(),o=a.split(",");switch(r[0].tagName){case"event":for(var l=0;l<o.length;l++)n=o[l],this.getScreen(n).doClickEventById(this.getElementId(n),e);break;case"css":for(var h=r.attr("name").toString(),c=0;c<o.length;c++)n=o[c],s="this"==n?e:this.getScreen(n).getElementById(this.getElementId(n)),$(s._container).removeClass(),$(s._container).addClass(h);break;case"url":var m=r.attr("address"),_=window.open(m);_.focus();break;case"anim":for(var u=0;u<o.length;u++){n=o[u],s="this"==n?e:this.getScreen(n).getElementById(this.getElementId(n));var d=s._anim;s._anim=r.attr("type"),s._animtime=r.attr("animtime"),s._animdelay=r.attr("animdelay"),s._animease=r.attr("ease"),s._animOnComplete=r.attr("animcomplete")||null,s.animate(),s._anim=d}break;case"enable":for(var f=0;f<o.length;f++)n=o[f],s="this"==n?e:this.getScreen(n).getElementById(this.getElementId(n)),s.enable();break;case"disable":for(var p=0;p<o.length;p++)n=o[p],s="this"==o[p]?e:this.getScreen(n).getElementById(this.getElementId(n)),s.disable();break;case"function":var g=r.attr("name").toString(),x=r.text(),v=this;""==x&&(x=null),"this"==x&&(x=e);var y;if(-1!=g.indexOf(".")){var E=g.split(".");if("parent"==E[0].toLowerCase()){var b=this._screenElement;b&&(v=b.screen())}else{var y=this.getElementById(E[0]);y&&y._elementScreen&&(v=y._elementScreen)}g=E[1]}v.searchForFunction(g,x)}}},searchForFunction:function(t,e){for(var i=0;i<this.getElementLoaderArray().length;i++){var n=this.getElementLoaderArray()[i];if(n._custom&&"function"==typeof n._custom[t]){e?n._custom[t](e,this):n._custom[t](this);break}}"function"==typeof this[t]&&(e?this[t](e,this):this[t](this)),"function"==typeof window[t]&&(e?window[t](e,this):window[t](this))},id:function(){return this._id},xmlPath:function(){return this._xmlPath}},function(t){function e(t){t=t||{},this.settings=t,null==t.statusInterval&&(t.statusInterval=5e3),null==t.loggingDelay&&(t.loggingDelay=2e4),null==t.noProgressTimeout&&(t.noProgressTimeout=1/0);var e,n=[],s=[],r=Date.now(),a={QUEUED:0,WAITING:1,LOADED:2,ERROR:3,TIMEOUT:4},o=function(t){return null==t?[]:Array.isArray(t)?t:[t]};this.add=function(t){t.tags=new i(t.tags),null==t.priority&&(t.priority=1/0),n.push({resource:t,status:a.QUEUED})},this.addProgressListener=function(t,e){s.push({callback:t,tags:new i(e)})},this.addCompletionListener=function(t,e){s.push({tags:new i(e),callback:function(e){e.completedCount===e.totalCount&&t(e)}})};var l=function(t){t=o(t);var e=function(e){for(var i=e.resource,n=1/0,s=0;s<i.tags.length;s++)for(var r=0;r<Math.min(t.length,n)&&!(i.tags.all[s]===t[r]&&n>r&&(n=r,0===n))&&0!==n;r++);return n};return function(t,i){var n=e(t),s=e(i);return s>n?-1:n>s?1:t.priority<i.priority?-1:t.priority>i.priority?1:0}};this.start=function(t){if(0==n.length)try{listener=s[1],listener.callback({completedCount:0,totalCount:0})}catch(i){}e=Date.now();var r=l(t);n.sort(r);for(var o=0,c=n.length;c>o;o++){var m=n[o];m.status=a.WAITING,m.resource.start(this)}setTimeout(h,100)};var h=function(){for(var e=!1,i=Date.now()-r,s=i>=t.noProgressTimeout,o=i>=t.loggingDelay,l=0,c=n.length;c>l;l++){var m=n[l];m.status===a.WAITING&&(m.resource.checkStatus&&m.resource.checkStatus(),m.status===a.WAITING&&(s?m.resource.onTimeout():e=!0))}o&&e&&_(),e&&setTimeout(h,t.statusInterval)};this.isBusy=function(){for(var t=0,e=n.length;e>t;t++)if(n[t].status===a.QUEUED||n[t].status===a.WAITING)return!0;return!1};var c=function(t,e){var i,o,l,h,c,_=null;for(i=0,o=n.length;o>i;i++)if(n[i].resource===t){_=n[i];break}if(null!=_&&_.status===a.WAITING)for(_.status=e,r=Date.now(),l=t.tags.length,i=0,o=s.length;o>i;i++)h=s[i],c=0===h.tags.length?!0:t.tags.intersects(h.tags),c&&m(_,h)};this.onLoad=function(t){c(t,a.LOADED)},this.onError=function(t){c(t,a.ERROR)},this.onTimeout=function(t){c(t,a.TIMEOUT)};var m=function(t,e){var i,s,r,o,l=0,h=0;for(i=0,s=n.length;s>i;i++)r=n[i],o=!1,o=0===e.tags.length?!0:r.resource.tags.intersects(e.tags),o&&(h++,(r.status===a.LOADED||r.status===a.ERROR||r.status===a.TIMEOUT)&&l++);e.callback({resource:t.resource,loaded:t.status===a.LOADED,error:t.status===a.ERROR,timeout:t.status===a.TIMEOUT,completedCount:l,totalCount:h})},_=this.log=function(t){if(window.console){var i=Math.round((Date.now()-e)/1e3);window.console.log("PxLoader elapsed: "+i+" sec");for(var s=0,r=n.length;r>s;s++){var o=n[s];if(t||o.status===a.WAITING){var l="PxLoader: #"+s+" "+o.resource.getName();switch(o.status){case a.QUEUED:l+=" (Not Started)";break;case a.WAITING:l+=" (Waiting)";break;case a.LOADED:l+=" (Loaded)";break;case a.ERROR:l+=" (Error)";break;case a.TIMEOUT:l+=" (Timeout)"}o.resource.tags.length>0&&(l+=" Tags: ["+o.resource.tags.all.join(",")+"]"),window.console.log(l)}}}}}function i(t){if(this.all=[],this.first=null,this.length=0,this.lookup={},t){if(Array.isArray(t))this.all=t.slice(0);else if("object"==typeof t)for(var e in t)t.hasOwnProperty(e)&&this.all.push(e);else this.all.push(t);this.length=this.all.length,this.length>0&&(this.first=this.all[0]);for(var i=0;i<this.length;i++)this.lookup[this.all[i]]=!0}}i.prototype.intersects=function(t){if(0===this.length||0===t.length)return!1;if(1===this.length&&1===t.length)return this.first===t.first;if(t.length<this.length)return t.intersects(this);for(var e in this.lookup)if(t.lookup[e])return!0;return!1},"function"==typeof define&&define.amd&&define("PxLoader",[],function(){return e}),t.PxLoader=e}(this),Date.now||(Date.now=function(){return(new Date).getTime()}),Array.isArray||(Array.isArray=function(t){return"[object Array]"===Object.prototype.toString.call(t)}),PxLoader.prototype.addImage=function(t,e,i){var n=new PxLoaderImage(t,e,i);return this.add(n),n.img},"function"==typeof define&&define.amd&&define("PxLoaderImage",[],function(){return PxLoaderImage}),Element.prototype={elementLoader:function(){return this._elementLoader},createInstanceName:function(){return"instance"+this.elementLoader().getElements().length},getTarget:function(){var t,e=this._screen._container;if(this._xml.attr("target")&&""!=this._xml.attr("target")){if(t=this.elementLoader().getElementById(this._xml.attr("target")))return t._container;if(get(this._xml.attr("target")))return get(this._xml.attr("target"))}return this._target?this._target:e},create:function(){if(this._container=this.createDiv(),this._initialAnimComplete=!1,this.elementHasNoAnim()&&(this._initialAnimComplete=!0),"screen"==this._type){var t={screenXML:this._xml,screenElement:this},e=new Screen(t);this._elementScreen=e,e.load(this._container,!0)}if("text"===this._type&&new Text({element:this,container:this._container,xml:this._xml}),"box"===this._type&&new Box({element:this,container:this._container,xml:this._xml}),"button"===this._type&&new Button({element:this,container:this._container,xml:this._xml}),"custom"===this._type)switch(this._xml.attr("type").toLowerCase()){case"mcq":this._custom=new MCQ({element:this});break;case"quiz":this._custom=new Quiz({element:this});break;default:alert("unrecognised custom screen element "+this._xml.attr("type"))}},elementHasNoAnim:function(){return null==this._anim||"none"==this._anim||"hidden"==this._anim||"hide"==this._anim||"disabled"==this._anim||"disable"==this._anim||0==this._eventq},registerAnimComplete:function(){this._initialAnimComplete=!0,this._animOnComplete?this._screen.doClickEventById(this._animOnComplete,this):!1,this.elementLoader().checkBatchAnimsComplete()},createDiv:function(){var t=create({type:"div",id:this._id});if(xmlAttrStr(this._xml,"position")){var e=this._xml.attr("position");$(t).css("position",e)}else $(t).css("position","absolute");if($(t).css("visibility","hidden"),xmlAttrStr(this._xml,"margin")&&$(t).css("margin",this._xml.attr("margin")),xmlAttrStr(this._xml,"margin-top")&&$(t).css("margin-top",getUnit(this._xml.attr("margin-top"))),xmlAttrStr(this._xml,"margin-right")&&$(t).css("margin-right",getUnit(this._xml.attr("margin-right"))),xmlAttrStr(this._xml,"margin-bottom")&&$(t).css("margin-bottom",getUnit(this._xml.attr("margin-bottom"))),xmlAttrStr(this._xml,"margin-left")&&$(t).css("margin-left",getUnit(this._xml.attr("margin-left"))),xmlAttrStr(this._xml,"min-width")&&$(t).css("min-width",getUnit(this._xml.attr("min-width"))),xmlAttrStr(this._xml,"max-width")&&$(t).css("max-width",getUnit(this._xml.attr("max-width"))),xmlAttrStr(this._xml,"min-height")&&$(t).css("min-height",getUnit(this._xml.attr("min-height"))),xmlAttrStr(this._xml,"max-height")&&$(t).css("max-height",getUnit(this._xml.attr("max-height"))),xmlAttrStr(this._xml,"z-index")&&$(t).css("z-index",this._xml.attr("z-index")),xmlAttrStr(this._xml,"float")&&$(t).css("float",this._xml.attr("float")),xmlAttrStr(this._xml,"clear")&&$(t).css("clear",this._xml.attr("clear")),xmlAttrStr(this._xml,"display")&&$(t).css("display",this._xml.attr("display")),xmlAttrStr(this._xml,"overflow")&&$(t).css("overflow",this._xml.attr("overflow")),"image"!=this._type&&(xmlAttrStr(this._xml,"className")&&$(t).addClass(this._xml.attr("className")),xmlAttrStr(this._xml,"class")&&$(t).addClass(this._xml.attr("class"))),this._scroll){var i=this._xml.attr("scroll").toLowerCase(),n=-1!=i.indexOf("x"),s=-1!=i.indexOf("y");-1!=i.indexOf("touch")?supportsTouch&&(n?$(t).css("overflow-x","auto"):s?$(t).css("overflow-y","auto"):($(t).css("overflow-y","auto"),$(t).css("overflow-x","auto"))):n?($(t).css("overflow-x","auto"),$(t).css("overflow-y","hidden")):s?($(t).css("overflow-y","auto"),$(t).css("overflow-x","hidden")):($(t).css("overflow-y","auto"),$(t).css("overflow-x","auto")),$(t).css("-webkit-overflow-scrolling","touch")}var r=-1!=this._x.toString().indexOf("+=")||-1!=this._x.toString().indexOf("-=")||"match"===this._x.toString().toLowerCase()||"center"===this._x.toString().toLowerCase()||-1!=this._y.toString().indexOf("+=")||-1!=this._y.toString().indexOf("-=")||"match"===this._y.toString().toLowerCase()||"center"===this._y.toString().toLowerCase();r&&(this._relativePos=!0),r||(this._x=parseInt(this._x),this._y=parseInt(this._y),$(t).css("left",this._x),$(t).css("top",this._y));var a=this.elementLoader().getPreviousElement(this._id);if(this._width){var o=this._width;"match"===o.toString().toLowerCase()&&a&&(o=a._width),this._width=o,$(t).css("width",this._width)}if(this._height){var l=this._height;"match"===l.toString().toLowerCase()&&a&&(l=a._height),this._height=l,$(t).css("height",this._height)}return $(this.getTarget()).append(t),$(t).css("opacity",0),t},positionRelatively:function(){var t=this.elementLoader().getPreviousElement(this._id);if(t){if("match"===this._x.toString().toLowerCase()&&(this._x=parseInt(t._x)),-1!=this._x.toString().indexOf("+=")||-1!=this._x.toString().indexOf("-=")){var e=parseInt(this._x.substring(2));this._x=parseInt(t._x)+parseInt($(t._container).innerWidth())+e}if("center"===this._x.toString().toLowerCase()&&(this._x=t._x+$(t._container).innerWidth()/2-$(this._container).innerWidth()/2),"match"===this._y.toString().toLowerCase()&&(this._y=parseInt(t._y)),-1!=this._y.toString().indexOf("+=")||-1!=this._y.toString().indexOf("-=")){var i=parseInt(this._y.substring(2));this._y=parseInt(t._y)+parseInt($(t._container).innerHeight())+i}"center"===this._y.toString().toLowerCase()&&(this._y=t._y+$(t._container).innerHeight()/2-$(this._container).innerHeight()/2)}this._x=parseInt(this._x),this._y=parseInt(this._y),$(this._container).css("left",this._x),$(this._container).css("top",this._y)},animate:function(){for(var t,e=this._anim.split("|"),i=0;i<e.length;i++){t=e[i];var n;-1!=t.indexOf("top_")&&(n=t.split("_")[1],-1!=n.toString().indexOf("+=")&&(n=this._y+Number(n.toString().replace("+=",""))),-1!=n.toString().indexOf("-=")&&(n=this._y-Number(n.toString().replace("-=",""))),-1!=n.toString().indexOf("orig")&&(n=this._y),t="moveTop");var s;-1!=t.indexOf("left_")&&(s=t.split("_")[1],-1!=s.toString().indexOf("+=")&&(s=this._x+Number(s.replace("+=",""))),-1!=s.toString().indexOf("-=")&&(s=this._x-Number(s.replace("-=",""))),-1!=s.toString().indexOf("orig")&&(s=this._x),t="moveLeft");var r;if(-1!=t.indexOf("scale_"))r=parseFloat(t.split("_")[1]),r>1&&(r/=100),t=-1!=t.indexOf("lscale_")?"lscale":"scale";else{var a=1;"undefined"!=typeof TweenMax&&this._container._gsTransform&&(a=this._container._gsTransform.scaleX),r=a}var o=50,l=(this._animease,this);switch(t){case"remove":var h={opacity:0};$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:function(){$(l._container).remove()}});break;case"enable":case"enabled":"button"==this._type?this.enableBtn():this.enable();break;case"disable":case"disabled":if("button"==this._type){var h={opacity:.3};$(this._container).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.disableBtn.bind(this)})}else this.disable();break;case"hidden":case"hide":var h={opacity:0};$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:function(){l.registerAnimComplete.bind(l),$(l._container).css("visiblity","hidden")}});break;case"alpha":case"show":var h={opacity:1,queue:!1};$(this._container).css("visibility","visible"),$(this._container).css("opacity",0),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"top":var h={top:this._y,opacity:1},c=-1*parseInt($(this._screen._container).css("height"))-o;$(this._container).css("top",c),$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"bottom":var h={top:this._y,opacity:1},c=parseInt($(this._screen._container).css("height"))+o;$(this._container).css("top",c),$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"left":var h={left:this._x,opacity:1},c=-1*parseInt($(this._screen._container).css("width"))-o;$(this._container).css("left",c),$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"right":var h={left:this._x,opacity:1},c=parseInt($(this._screen._container).css("width"))+o;$(this._container).css("left",c),$(this._container).css("visibility","visible"),$(this._container).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"moveTop":case"movetop":var h={top:n,opacity:1};$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"moveLeft":case"moveleft":var h={left:s,opacity:1};$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"drop":var h={scale:1,opacity:1};$(this._container).css("scale",3),$(this._container).css("opacity",0),$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"scale":var h={scale:r,opacity:1};$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;case"lscale":break;case"scaleup":var h={scale:1,opacity:1};$(this._container).css("scale",0),$(this._container).css("opacity",0),$(this._container).css("visibility","visible"),$(this._container).stop(!0,!1).delay(1e3*this._animdelay).animate(h,{duration:1e3*this._animtime,easing:JQEase(this._animease),complete:this.registerAnimComplete.bind(this)});break;default:$(this._container).show(),$(this._container).css("visibility","visible"),$(this._container).css("opacity",1),this.registerAnimComplete()}}},registerEvents:function(){if("disabled"!=this._anim&&"disable"!=this._anim){this._arRollovers=[],this._arRollouts=[],this._arClicks=[];var t,e=!1,i=!1,n=!1,s=this._event.split(",");$(this._container).off();for(var r=0;r<s.length;r++)if(t=this._screen.getEventById(s[r])){if(t._arRollovers.length>0){e=!0;for(var a=0;a<t._arRollovers.length;a++)this._arRollovers.push(t._arRollovers[a])}if(t._arRollouts.length>0){i=!0;for(var a=0;a<t._arRollouts.length;a++)this._arRollouts.push(t._arRollouts[a]),this._screen.fireEvents(t._arRollouts[a],this)}if(t._arClicks.length>0){n=!0;for(var a=0;a<t._arClicks.length;a++)this._arClicks.push(t._arClicks[a])}}else alert("event not found:"+s[r]);e&&(this._screen.fireEvents(this._arRollouts,this),$(this._container).on("mouseenter",this.mouseOverHandler.bind(this)),$(this._container).css("cursor","pointer")),i&&$(this._container).on("mouseleave",this.mouseOutHandler.bind(this)),n&&($(this._container).on("click",this.clickHandler.bind(this)),$(this._container).css("cursor","pointer"),$(this._container).children().css("cursor","pointer"))}},mouseOverHandler:function(){this._screen.fireEvents(this._arRollovers,this)},mouseOutHandler:function(){this._screen.fireEvents(this._arRollouts,this)},clickHandler:function(t){t.stopPropagation(),t.preventDefault(),this._screen.fireEvents(this._arClicks,this)},disable:function(){$(this._container).off(),$(this._container).css("cursor","default"),$(this._container).children().css("cursor","default")},enable:function(){this._event&&(("disabled"==this._anim||"disable"==this._anim)&&(this._anim="alpha"),this.registerEvents())},disableBtn:function(){this.disable(),$(this._container).find("input").css("cursor","default"),$(this._container).css("visibility","visible"),$(this._container).css("zoom","1"),$(this._container).css("display","block"),$(this._container).css("opacity",.2)},enableBtn:function(){this.enable(),$(this._container).find("input").css("cursor","pointer"),$(this._container).css("visibility","visible"),$(this._container).css("opacity",1),$(this._container).css("display","block")},rollover:function(){for(var t=0;t<this._arRollovers.length;t++)this._screen.fireEvents(this._arRollovers[t],this)},rollout:function(){for(var t=0;t<this._arRollouts.length;t++)this._screen.fireEvents(this._arRollouts[t],this)},hide:function(){$(this._container).css("opacity",0),$(this._container).hide()},show:function(){$(this._container).css("opacity",1),$(this._container).show()},reset:function(){this.elementHasNoAnim()||this.hide(),("hidden"===this._anim||"hide"===this._anim)&&this.hide(),this._event&&(this._arRollouts.length>0&&this.rollout(),this.enable()),this._container.x=this._x,this._container.y=this._y}},ElementLoader.prototype={load:function(){this._batchFinished=!1,this.attachPreloader();for(var t=0;t<this._arElements.length;t++)this._arElements[t]._container&&(this._arElements[t]._container=null),this._arElements[t].create();for(var t=0;t<this._arElements.length;t++)if(this._arElements[t]._elementLoader=this,"image"==this._arElements[t]._type){var e=this._arElements[t]._xml.text(),i=new PxLoaderImage(e);i.element=this._arElements[t],this._loader.add(i)}this._loader.start()},delayRelativePos:function(t){setTimeout(function(){t.positionRelatively(),t.animate()},100)},delayAnimate:function(t){setTimeout(function(){t.animate()},100)},checkAllAnimsComplete:function(){for(var t=!0,e=0;e<this._arElements.length;e++)if(!this._arElements[e]._initialAnimComplete){t=!1;break}return t},checkBatchAnimsComplete:function(){var t=this.checkAllAnimsComplete();if(t&&!this._batchFinished){this._batchFinished=!0;for(var e=0;e<this._arElements.length;e++)if(this._arElements[e]._event&&this._arElements[e].registerEvents(),"custom"==this._arElements[e]._type)try{this._arElements[e]._custom.init()}catch(i){}this._onAnimsComplete&&(this._onCompleteParams?this._onCompleteScope[this._onAnimsComplete](this._onCompleteParams):this._onCompleteScope[this._onAnimsComplete]())}},showPreloader:function(){$(this._preloader).show()},attachPreloader:function(){if(!get("preloader")){var t=($(this._screen._container).innerWidth()-34)/2,e=($(this._screen._container).innerHeight()-34)/2;this._preloader=create({type:"div",id:"preloader"}),$(this._preloader).css("position","absolute"),$(this._preloader).css("z-index",999),$(this._preloader).css("left",t),$(this._preloader).css("top",e),$(this._preloader).addClass("preloader"),$(this._preloader).hide(),this._screen._container.appendChild(this._preloader),this.showPreloader()
}},removePreloader:function(){pl=this._preloader,this._screen._container.removeChild(pl),this._preloader=null},hidePreloader:function(){this._preloader&&$(this._preloader).animate({opacity:0},{duration:1e3,complete:this.removePreloader.bind(this)})},getElements:function(){return this._arElements},addElement:function(t){t._elementLoader=this,this.getElements().push(t)},getElementById:function(t){for(var e=null,i=0;i<this._arElements.length;i++)if(this._arElements[i]._id==t){e=this._arElements[i];break}return e},getElementByType:function(t){for(var e=null,i=0;i<this._arElements[i].length;i++)if(this._arElements[i]._type==t){e=this._arElements[i];break}return e},getPreviousElement:function(t){for(var e=null,i=0;i<this._arElements.length;i++)if(this._arElements[i]._id==t&&i>0){e=this._arElements[i-1];break}return e},getNextElement:function(t){for(var e=null,i=0;i<this._arElements.length;i++)if(this._arElements[i]._id==t&&i<this._arElements.length-1){e=this._arElements[i+1];break}return e},stop:function(){this._loader.addCompletionListener(function(){return!1}),this._loader.addProgressListener(function(){return!1}),this._onLoadComplete=null,this._onAnimsComplete=null}};
/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});

/*
 *
 * TERMS OF USE - EASING EQUATIONS
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2001 Robert Penner
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
 */
(function(t,e){if(typeof define==="function"&&define.amd){define(["jquery"],e)}else if(typeof exports==="object"){module.exports=e(require("jquery"))}else{e(t.jQuery)}})(this,function(t){t.transit={version:"0.9.12",propertyMap:{marginLeft:"margin",marginRight:"margin",marginBottom:"margin",marginTop:"margin",paddingLeft:"padding",paddingRight:"padding",paddingBottom:"padding",paddingTop:"padding"},enabled:true,useTransitionEnd:false};var e=document.createElement("div");var n={};function i(t){if(t in e.style)return t;var n=["Moz","Webkit","O","ms"];var i=t.charAt(0).toUpperCase()+t.substr(1);for(var r=0;r<n.length;++r){var s=n[r]+i;if(s in e.style){return s}}}function r(){e.style[n.transform]="";e.style[n.transform]="rotateY(90deg)";return e.style[n.transform]!==""}var s=navigator.userAgent.toLowerCase().indexOf("chrome")>-1;n.transition=i("transition");n.transitionDelay=i("transitionDelay");n.transform=i("transform");n.transformOrigin=i("transformOrigin");n.filter=i("Filter");n.transform3d=r();var a={transition:"transitionend",MozTransition:"transitionend",OTransition:"oTransitionEnd",WebkitTransition:"webkitTransitionEnd",msTransition:"MSTransitionEnd"};var o=n.transitionEnd=a[n.transition]||null;for(var u in n){if(n.hasOwnProperty(u)&&typeof t.support[u]==="undefined"){t.support[u]=n[u]}}e=null;t.cssEase={_default:"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeInCubic:"cubic-bezier(.550,.055,.675,.190)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};t.cssHooks["transit:transform"]={get:function(e){return t(e).data("transform")||new f},set:function(e,i){var r=i;if(!(r instanceof f)){r=new f(r)}if(n.transform==="WebkitTransform"&&!s){e.style[n.transform]=r.toString(true)}else{e.style[n.transform]=r.toString()}t(e).data("transform",r)}};t.cssHooks.transform={set:t.cssHooks["transit:transform"].set};t.cssHooks.filter={get:function(t){return t.style[n.filter]},set:function(t,e){t.style[n.filter]=e}};if(t.fn.jquery<"1.8"){t.cssHooks.transformOrigin={get:function(t){return t.style[n.transformOrigin]},set:function(t,e){t.style[n.transformOrigin]=e}};t.cssHooks.transition={get:function(t){return t.style[n.transition]},set:function(t,e){t.style[n.transition]=e}}}p("scale");p("scaleX");p("scaleY");p("translate");p("rotate");p("rotateX");p("rotateY");p("rotate3d");p("perspective");p("skewX");p("skewY");p("x",true);p("y",true);function f(t){if(typeof t==="string"){this.parse(t)}return this}f.prototype={setFromString:function(t,e){var n=typeof e==="string"?e.split(","):e.constructor===Array?e:[e];n.unshift(t);f.prototype.set.apply(this,n)},set:function(t){var e=Array.prototype.slice.apply(arguments,[1]);if(this.setter[t]){this.setter[t].apply(this,e)}else{this[t]=e.join(",")}},get:function(t){if(this.getter[t]){return this.getter[t].apply(this)}else{return this[t]||0}},setter:{rotate:function(t){this.rotate=b(t,"deg")},rotateX:function(t){this.rotateX=b(t,"deg")},rotateY:function(t){this.rotateY=b(t,"deg")},scale:function(t,e){if(e===undefined){e=t}this.scale=t+","+e},skewX:function(t){this.skewX=b(t,"deg")},skewY:function(t){this.skewY=b(t,"deg")},perspective:function(t){this.perspective=b(t,"px")},x:function(t){this.set("translate",t,null)},y:function(t){this.set("translate",null,t)},translate:function(t,e){if(this._translateX===undefined){this._translateX=0}if(this._translateY===undefined){this._translateY=0}if(t!==null&&t!==undefined){this._translateX=b(t,"px")}if(e!==null&&e!==undefined){this._translateY=b(e,"px")}this.translate=this._translateX+","+this._translateY}},getter:{x:function(){return this._translateX||0},y:function(){return this._translateY||0},scale:function(){var t=(this.scale||"1,1").split(",");if(t[0]){t[0]=parseFloat(t[0])}if(t[1]){t[1]=parseFloat(t[1])}return t[0]===t[1]?t[0]:t},rotate3d:function(){var t=(this.rotate3d||"0,0,0,0deg").split(",");for(var e=0;e<=3;++e){if(t[e]){t[e]=parseFloat(t[e])}}if(t[3]){t[3]=b(t[3],"deg")}return t}},parse:function(t){var e=this;t.replace(/([a-zA-Z0-9]+)\((.*?)\)/g,function(t,n,i){e.setFromString(n,i)})},toString:function(t){var e=[];for(var i in this){if(this.hasOwnProperty(i)){if(!n.transform3d&&(i==="rotateX"||i==="rotateY"||i==="perspective"||i==="transformOrigin")){continue}if(i[0]!=="_"){if(t&&i==="scale"){e.push(i+"3d("+this[i]+",1)")}else if(t&&i==="translate"){e.push(i+"3d("+this[i]+",0)")}else{e.push(i+"("+this[i]+")")}}}}return e.join(" ")}};function c(t,e,n){if(e===true){t.queue(n)}else if(e){t.queue(e,n)}else{t.each(function(){n.call(this)})}}function l(e){var i=[];t.each(e,function(e){e=t.camelCase(e);e=t.transit.propertyMap[e]||t.cssProps[e]||e;e=h(e);if(n[e])e=h(n[e]);if(t.inArray(e,i)===-1){i.push(e)}});return i}function d(e,n,i,r){var s=l(e);if(t.cssEase[i]){i=t.cssEase[i]}var a=""+y(n)+" "+i;if(parseInt(r,10)>0){a+=" "+y(r)}var o=[];t.each(s,function(t,e){o.push(e+" "+a)});return o.join(", ")}t.fn.transition=t.fn.transit=function(e,i,r,s){var a=this;var u=0;var f=true;var l=t.extend(true,{},e);if(typeof i==="function"){s=i;i=undefined}if(typeof i==="object"){r=i.easing;u=i.delay||0;f=typeof i.queue==="undefined"?true:i.queue;s=i.complete;i=i.duration}if(typeof r==="function"){s=r;r=undefined}if(typeof l.easing!=="undefined"){r=l.easing;delete l.easing}if(typeof l.duration!=="undefined"){i=l.duration;delete l.duration}if(typeof l.complete!=="undefined"){s=l.complete;delete l.complete}if(typeof l.queue!=="undefined"){f=l.queue;delete l.queue}if(typeof l.delay!=="undefined"){u=l.delay;delete l.delay}if(typeof i==="undefined"){i=t.fx.speeds._default}if(typeof r==="undefined"){r=t.cssEase._default}i=y(i);var p=d(l,i,r,u);var h=t.transit.enabled&&n.transition;var b=h?parseInt(i,10)+parseInt(u,10):0;if(b===0){var g=function(t){a.css(l);if(s){s.apply(a)}if(t){t()}};c(a,f,g);return a}var m={};var v=function(e){var i=false;var r=function(){if(i){a.unbind(o,r)}if(b>0){a.each(function(){this.style[n.transition]=m[this]||null})}if(typeof s==="function"){s.apply(a)}if(typeof e==="function"){e()}};if(b>0&&o&&t.transit.useTransitionEnd){i=true;a.bind(o,r)}else{window.setTimeout(r,b)}a.each(function(){if(b>0){this.style[n.transition]=p}t(this).css(l)})};var z=function(t){this.offsetWidth;v(t)};c(a,f,z);return this};function p(e,i){if(!i){t.cssNumber[e]=true}t.transit.propertyMap[e]=n.transform;t.cssHooks[e]={get:function(n){var i=t(n).css("transit:transform");return i.get(e)},set:function(n,i){var r=t(n).css("transit:transform");r.setFromString(e,i);t(n).css({"transit:transform":r})}}}function h(t){return t.replace(/([A-Z])/g,function(t){return"-"+t.toLowerCase()})}function b(t,e){if(typeof t==="string"&&!t.match(/^[\-0-9\.]+$/)){return t}else{return""+t+e}}function y(e){var n=e;if(typeof n==="string"&&!n.match(/^[\-0-9\.]+/)){n=t.fx.speeds[n]||t.fx.speeds._default}return b(n,"ms")}t.transit.getTransitionValue=d;return t});
/**
 * MCQ
 * VERSION: 2.0
 * JS
 * AUTHOR: Ian Duff
 * COPYRIGHT: Essemble Ltd
 * All code © 2015 Essemble Ltd. all rights reserved
 * This code is the property of Essemble Ltd and cannot be copied, reused or modified without prior permission
 **/

function MCQ(vars) {
	//constructor
	//note: quiz extends this class
		
	this._screen = vars.element._screen;
	this._element = vars.element;
	this._container = vars.element._container;
	this._xml = vars.element._xml;
	
	this._arQs = [];//question array
	this._iCurQ = 0;//current question
	this._radioBtn = false;//attach a radio button to each option
	this._radioBtnX = 0;
	this._radioBtnY = 0;
	this._correctX = 0;
	this._correctY = 0;
	this._fb = null;
	
	this._maxAttempts = null;
	this._numAttempts = 0;
	this._forceMany = false;//multiple selections can be forced in the xml settings
	
	//read the settings
	//<settings radiobutton="true" radiobuttonx="10" radiobuttony="10" correctx="-20" correcty="8"/>
	var settings = this._xml.find("settings");
	if(settings.length > 0){
		if(xmlAttrStr(settings,"radiobutton")) this._radioBtn = Boolean(settings.attr("radiobutton").toLowerCase() == "true");
		if(xmlAttrNum(settings,"radiobuttonx")) this._radioBtnX = parseInt(settings.attr("radiobuttonx"));
		if(xmlAttrNum(settings,"radiobuttony")) this._radioBtnY = parseInt(settings.attr("radiobuttony"));
		if(xmlAttrNum(settings,"correctx")) this._correctX = parseInt(settings.attr("correctx"));
		if(xmlAttrNum(settings,"correcty")) this._correctY = parseInt(settings.attr("correcty"));
		if(xmlAttrNum(settings,"attempts")) this._maxAttempts = parseInt(settings.attr("attempts"));
		if(xmlAttrStr(settings,"manyfrommany")) this._forceMany = Boolean(settings.attr("manyfrommany").toLowerCase() == "true");
	}
	
	var scope = this;
	$(this._xml).find('question').each(function () {
		scope.makeQuestionObj($(this))
    });
}

MCQ.prototype = {
	//MCQ methods
	
	makeQuestionObj:function(xml){
		//for each question create a question object
		//the object has an element array, option array and feedback array
		//question properties
		//question container
		//option container
		//feedback container
		//methods to return the current question elements, options and feedbacks by id
		var qObj = {};
		qObj._id = xml.attr("id")  || "question" + this._arQs.length+1;
		qObj._time = xml.attr("time") || 0;
		qObj._xml = xml;
		qObj._arElements = []; //stores all the option elements and supporting elements for this question
		qObj._arOptions = []; //stores all option objects (a property of which is the option element) for this question
		qObj._arFbs = []; //stores feedback objects for this question (pass, partial, fail)
		qObj._radioMode = true;
		qObj._bPassed = false;
		qObj._event = null;
		if(xml.attr("event")) qObj._event = xml.attr("event");
		
		//the question container will hold everything 
		qObj._qContainer = create({ type: "div", id: "questionContainer" });
		this._container.appendChild(qObj._qContainer);
		
		//option container will contain the question options, buttons and any supporting elements
		qObj._optionContainer = create({ type: "div", id: "optionContainer" }); 
		$(qObj._optionContainer).css("left",0);  
		$(qObj._optionContainer).css("top",0); 
		qObj._qContainer.appendChild(qObj._optionContainer);

		//feedback container
		qObj._fbContainer = create({ type: "div", id: "feedbackContainer" }); 
		$(qObj._fbContainer).css("left",0); 
		$(qObj._fbContainer).css("top",0); 
		qObj._qContainer.appendChild(qObj._fbContainer); 
		
		
		qObj.getElementById = function(id){
			var ret = null;
			for (var i=0;i<this._arElements.length;i++){
				if(this._arElements[i]._id == id){
					ret = this._arElements[i];
					break;
				}
			}
			return ret;
		}
		qObj.getOptionById = function(id){
			var ret = null;
			for (var i=0;i<this._arOptions.length;i++){
				if(this._arOptions[i]._id == id){
					ret = this._arOptions[i];
					break;
				}
			}
			return ret;
		}
		qObj.getFeedbackById = function(id){
			var ret = null;
			for (var i=0;i< this._arFbs.length;i++){
				if(this._arFbs[i]._id == id){
					ret = this._arFbs[i];
					break;
				}
			}
			return ret;
		}
		
		//for each question create 3 arrays:
		//qObj._arElements (contains options and supporting elements, including confirm and reset buttons)
		//qObj._arOptions (contains option objects)
		//qObj._arFbs (contains feedback objects)
		
		var correctCount = 0;
		var scope = this;
		$(xml).children().each(function(){
			var nodeType = this.tagName;
			switch(nodeType){
				case "option":
					var firstElement = $(this).children()[0];
					var oOptionElement = new Element({screen:scope._screen, xml:firstElement});
					oOptionElement._target = qObj._optionContainer;
					scope._screen.getElementLoaderArray().push(oOptionElement);//add them to the screen element array
					qObj._arElements.push(oOptionElement);//also add them to the object._arElements array for local control
					
					//create an option object 
					//this so we can loop thru just the options in each question
					//properties include: correct, selected, element, (specific) feedback
					//push to the qObj._arOptions array
					var qOptionObj = {};
					qOptionObj._id = oOptionElement._id;
					qOptionObj._element = oOptionElement;
					qOptionObj._correct = Boolean($(this).attr("correct").toLowerCase() == "true");
					qOptionObj._selected = false;
					qOptionObj._feedback = null;
	
					//radio mode is when there is only one correct answer
					//in radio mode only one option can be selected at a time
					if(qOptionObj._correct) correctCount++;
					if(correctCount > 1 || scope._forceMany) qObj._radioMode = false;
					qObj._arOptions.push(qOptionObj);
				break;
				
				case "fb":
					//create a feedback object
					//properties are id (either option id or "pass","partial","fail")
					//and an array of elements
					//push to the qObj._arFbs array
					var fbObj = {};
					fbObj._id = $(this).attr("id");
					fbObj._xml = $(this).children();
					fbObj._elements = [];
					fbObj._event = null;
					if($(this).attr("event")) fbObj._event = $(this).attr("event");
					
					$(this).children().each(function(){
						var el = new Element({screen:scope._screen, xml:this });
						fbObj._elements.push(el);
					})
					
					qObj._arFbs.push(fbObj);
				break;
				
				default:
					//all other elements, e.g. buttons (confirm & reset), additional text, images, audio, video
					var otherEl = new Element({screen:scope._screen, xml:this });
					otherEl._target = qObj._optionContainer;
					scope._screen.getElementLoaderArray().push(otherEl);//add them to the screen element array
					qObj._arElements.push(otherEl);//also add them to the object._arElements array for local control
				break;
			}
			
			scope._arQs.push(qObj);
		});
	},
	
	init:function(){
		//init called from the ElementLoader 
		//when all elements in the batch have loaded and animated
		this.loadQuestion(this._iCurQ);
	},
	
	loadQuestion:function(id){
		var q = this.curQ();
		if(q._event) this._screen.doClickEventById(q._event);
	},
	
	select:function(element){
		var q = this.curQ();
		var selectedOption = q.getOptionById(element._id);
		
		if(q._radioMode){
			element.disable();
			for (var i=0; i<q._arOptions.length;i++){
				if(q._arOptions[i]._element != element){
					q._arOptions[i]._element.enable();
					q._arOptions[i]._selected = false;
				} 
			}
			selectedOption._selected = true;
		} else {
			if(selectedOption._selected){
				//deselect
				selectedOption._selected = false;
				element.enable();
				element.rollout();
				$(element._container).on('mouseenter', element.mouseOverHandler.bind(element));
				$(element._container).on('mouseleave', element.mouseOutHandler.bind(element));
			} else {
				//select
				//disable rollover events
				selectedOption._selected = true;
				$(element._container).off('mouseenter');
				$(element._container).off('mouseleave');
			}
		}

		//if any of the options have been selected, enable the confirm btn, otherwise disable it
		var bEnable = false;
		for (var i=0; i<q._arOptions.length;i++) {
			if(q._arOptions[i]._selected) bEnable = true;
		}
		
		var confirmBtn = q.getElementById("submitBtn");
		if(!confirmBtn) confirmBtn = this._screen.getElementById("submitBtn");
		if(confirmBtn){
			bEnable ? confirmBtn.enableBtn() : confirmBtn.disableBtn();
		}
	},
	
	submit:function(element){
		var q = this.curQ();
		var optionCorrectCount = 0;
		var userCorrectCount = 0;
		var allCorrect = false;
		//var fb = null;
		var selectedOptionPos = null; //remember the (last) selected option in case of specific feedback
		var count = 0;
		var bPartial = false;
		
		//disable confirm, enable reset
		var confirmBtn = q.getElementById("submitBtn");
		if(!confirmBtn) confirmBtn = this._screen.getElementById("submitBtn");
		if(confirmBtn) confirmBtn.disableBtn();
		
		var resetBtn = q.getElementById("resetBtn");
		if(!resetBtn) resetBtn = this._screen.getElementById("resetBtn");
		if(resetBtn) resetBtn.enableBtn();
		
		//disable options and work out which ones answered correctly
		for (var i=0;i<q._arOptions.length;i++) {
			q._arOptions[i]._element.disable();
			if(q._arOptions[i]._correct) { optionCorrectCount++; };
			if(q._arOptions[i]._selected && q._arOptions[i]._correct) { userCorrectCount++; bPartial = true;  };
			if(q._arOptions[i]._selected && !q._arOptions[i]._correct) userCorrectCount--;
			if(q._arOptions[i]._selected) {
				selectedOptionPos = (count+1);
			}
			count++;
		}
		
		//does the selected option have specific feedback? (returns null if not)
		var spFb = q.getFeedbackById(selectedOptionPos);

		if(userCorrectCount == optionCorrectCount){
			//all correct
			spFb ? this._fb = spFb : this._fb = q.getFeedbackById("pass");			
		} else if (bPartial){
			//some correct
			spFb ? this._fb = spFb : this._fb = q.getFeedbackById("partial");
		} else {
			//none correct
			spFb ? this._fb = spFb : this._fb = q.getFeedbackById("fail");
		}
		
		//target the feedback container
		for (var i=0;i<this._fb._elements.length;i++) {
			this._fb._elements[i]._target = q._fbContainer;
		}
		
		//send a copy of the feedback array to the element loader
		//this is so that if the loader array length is increased by box nested elements
		//the copied array is updated not the orginal array
		var fbCopy = [];
		fbCopy = this._fb._elements.slice();
		
		//load the feedback elements
		var fbLoader = new ElementLoader({screen:this._screen, elements:fbCopy, onAnimsComplete:"scrollToBottom", onCompleteScope:this});
		fbLoader.load();
		
		this.showCorrectAnswers();
		this._numAttempts++;
		
		//enable sca if appropriate
		if(userCorrectCount != optionCorrectCount){
			var scaBtn = q.getElementById("scaBtn");
			if(scaBtn){ 
				if(this._maxAttempts){						
					if(this._numAttempts >= this._maxAttempts){
						scaBtn.enableBtn(); 
					}
				} 
			}
		}
		
		//fire any events defined for the feedback
		if(this._fb._event) {
			var str = this._fb._event.split(" ").join("").toString();
			var arSplit = str.split(",")
			for(var i=0;i<arSplit.length;i++){
				this._screen.doClickEventById(arSplit[i],null);
			}
		}
	},

	scrollToBottom:function(){
		$('html, body').animate({ 
		   scrollTop: $(document).height()-$(window).height()}, 
		   1000, 
		   "easeOutQuint"
		);
	},
	
	showCorrectAnswers:function(){
		var q = this.curQ();
		for (var i=0;i<q._arOptions.length;i++) {
			if(q._arOptions[i]._correct && q._arOptions[i]._selected){
				var correct = create({type:"img", id:"correct"+(i+1), imgSrc:"lib/assets/tick_small.png", className:"tick"});
				var l = $(q._arOptions[i]._element._container).position().left + this._correctX;
				var t = $(q._arOptions[i]._element._container).position().top + this._correctY;
				//var l = this._correctX;
				//var t = this._correctY;
				$(correct).css("position","absolute");
				$(correct).css("left",l);
				$(correct).css("top",t);
				q._optionContainer.appendChild(correct);
				//q._arOptions[i]._element._container.appendChild(correct);
				console.log("ballbags"+ t)
			}
		}
	},
	
	showAllCorrectAnswers:function(){
		var q = this.curQ();
		for (var i=0;i<q._arOptions.length;i++) {
			if(q._arOptions[i]._correct){
				var correct = $(q._optionContainer).find(".tick");
				if(correct.length == 0) {
					var correct = create({type:"img", id:"correct"+(i+1) , imgSrc:"lib/assets/tick_small.png", className:"tick"});
					var l = $(q._arOptions[i]._element._container).position().left + this._correctX;
					var t = $(q._arOptions[i]._element._container).position().top + this._correctY;
					//var l = this._correctX;
					//var t = this._correctY;
					$(correct).css("position","absolute");
					$(correct).css("left",l);
					$(correct).css("top",t);
					q._optionContainer.appendChild(correct);
					//q._arOptions[i]._element._container.appendChild(correct);
				}
			}
		}
	},
	
	reset:function(element){
		var q = this.curQ();
		var confirmBtn = q.getElementById("submitBtn");
		if(!confirmBtn) confirmBtn = this._screen.getElementById("submitBtn");
		if(confirmBtn){
			confirmBtn.disableBtn();
			confirmBtn.rollout();
		}
		var resetBtn = q.getElementById("resetBtn");
		if(!resetBtn) resetBtn = this._screen.getElementById("resetBtn");
		if(resetBtn){
			resetBtn.disableBtn();
			resetBtn.rollout();
		}
		var scaBtn = q.getElementById("scaBtn");
		if(!scaBtn) scaBtn = this._screen.getElementById("scaBtn");
		if(scaBtn){ 
			scaBtn.hide();
			scaBtn.rollout(); 
		}
		
		//re-set the options
		for (var i=0;i<q._arOptions.length;i++) {
			q._arOptions[i]._selected = false;
			q._arOptions[i]._element.enable();
			
			//remove any ticks
			var correct = $(q._optionContainer).find(".tick");
			if(correct.length > 0) $(correct).remove();
		}
		
		//unload the feedback elements
		this.clearFeedbackContainer();
	},
	
	sca:function(vars){
		var q = this.curQ();
		var scaBtn = q.getElementById("scaBtn");
		if(scaBtn){ scaBtn.disableBtn(); }
		var fb = q.getFeedbackById("generic");
		if(fb){
			//unload the feedback elements
			this.clearFeedbackContainer();
			
			//target the feedback container
			for (var i=0;i<fb._elements.length;i++) {
				fb._elements[i]._target = q._fbContainer;
			}
		
			//send a copy of the feedback array to the element loader
			//this is so that if the loader array length is increased by box nested elements
			//the copied array is updated not the orginal array
			var fbCopy = [];
			fbCopy = fb._elements.slice();
			
			//load the feedback elements
			var fbLoader = new ElementLoader({screen:this._screen, elements:fbCopy});
			fbLoader.load();
			this.showAllCorrectAnswers();
			this._fb = fb;
		}
	},
	
	curQ:function(){
		return this._arQs[this._iCurQ];
	},
	
	clearQuestionContainer:function(){
		this.clearOptionContainer();
		this.clearFeedbackContainer();
	},
	
	clearOptionContainer:function(){
		this.curQ()._optionContainer.innerHTML = "";
	},
	
	clearFeedbackContainer:function(){
		if(this._fb){
			for(var i=0;i<this._fb._elements.length;i++){
				$(this._fb._elements[i]._container).remove();
			}
		}
	}
	
} //end prototype object

/*** Clock:* Copyright (c) 2013 Carlos Cabañero (c.cabanerochaparro@gmail.com) and contributors* Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. **/function Clock(params) {    var doStep = {};    var doDraw = {};    var type, initValue, data, time, showText, textColor, bodyColor, borderColor, bodyWidth, borderWidth, bodySeparation, fontFace, endCallback, dateStart, freq, netRadius, autoDraw, clockInterval, drawInterval;        this.params = params;    function setInitialClock(clock){    	        type = clock.params.type || Clock.TYPE_CLOCKWISE_INCREMENT;        initValue = clock.params.initValue || (type <= Clock.TYPE_CLOCKWISE_DECREMENT) ? 0 : 2;        data = initValue;        time = parseInt((clock.params.time) ? (clock.params.time) : 60);        showText = (clock.params.showText != null) ? (clock.params.showText) : true;        textColor = (showText) ? (clock.params.textColor || 'white') : null;        bodyColor = (clock.params.bodyColor) ? clock.params.bodyColor : '#FF0000';        borderColor = (clock.params.borderColor) ? clock.params.borderColor : 'transparent';        bodyWidth = clock.params.bodyWidth || 10;        borderWidth = clock.params.borderWidth || bodyWidth;        bodySeparation = (clock.params.bodySeparation) ? (clock.params.bodySeparation) : 0;        fontFace = (clock.params.fontFace) ? clock.params.fontFace : "'Roboto Condensed', sans-serif";        endCallback = clock.params.endCallBack || function() {            //console.log('TIME OUT!!');        };        dateStart = new Date();        freq = (clock.params.freq != null) ? clock.params.freq : 10;        netRadius = Math.max(bodyWidth, borderWidth);        autoDraw = (clock.params.autoDraw != null) ? clock.params.autoDraw : true;        clock.diff = 0;        //PUBLIC:        clock.ctx = clock.params.context;        clock.x = clock.params.x || 100,        clock.y = clock.params.y || 100,        clock.radius = clock.params.radius || 100;    }    this.init = function(){        setInitialClock(this);    }    //Draw Funcs    doStep[Clock.TYPE_CLOCKWISE_INCREMENT] = function(Clock) {        if (data >= 2) {            clearInterval(clockInterval);            clearInterval(drawInterval);             data = 2;            endCallback();            return;        }        var now = new Date();        Clock.diff = ((now.getTime() - dateStart.getTime()) / 1000);        data = Clock.diff * 2 / Clock.time;    };    doDraw[Clock.TYPE_CLOCKWISE_INCREMENT] = function(Clock) {        eraseZone(Clock);        drawBorder(Clock);        Clock.ctx.beginPath();        Clock.ctx.strokeStyle = bodyColor;        Clock.ctx.lineWidth = bodyWidth;        var quart = Math.PI / 2;        Clock.ctx.arc(Clock.x, Clock.y, Clock.radius, initValue * Math.PI - quart, data * Math.PI - quart, false);        Clock.ctx.stroke();        drawText(Clock);    };        doStep[Clock.TYPE_COUNTERCLOCKWISE_INCREMENT] = function(Clock) {        if (data <= 0) {            clearInterval(clockInterval);            clearInterval(drawInterval);            data = 2;            endCallback();            return;        }        var now = new Date();        Clock.diff = ((now.getTime() - dateStart.getTime()) / 1000);        data = 2 - Clock.diff * 2 / Clock.time;    };    doDraw[Clock.TYPE_COUNTERCLOCKWISE_INCREMENT] = function(Clock) {        eraseZone(Clock);        drawBorder(Clock);        Clock.ctx.beginPath();        Clock.ctx.strokeStyle = bodyColor;        Clock.ctx.lineWidth = bodyWidth;        Clock.ctx.arc(Clock.x, Clock.y, Clock.radius, data * Math.PI, 0 * Math.PI, false);        Clock.ctx.stroke();        drawText(Clock);    };    function drawBorder(Clock) {        Clock.ctx.beginPath();        Clock.ctx.strokeStyle = borderColor;        Clock.ctx.lineWidth = borderWidth;        Clock.ctx.arc(Clock.x, Clock.y, Clock.radius + bodySeparation, 0 * Math.PI, 2 * Math.PI, false);        Clock.ctx.stroke();    }    function drawText(Clock) {        if (!showText) {            return;        }        Clock.ctx.fillStyle = textColor;        Clock.ctx.font = "bold " + (Clock.radius / 1.2) + "px " + fontFace;        Clock.ctx.textAlign = 'center';        Clock.ctx.fillText(Math.ceil(Clock.time - Clock.diff), Clock.x, Clock.y + (Clock.radius / 4));        Clock.ctx.restore();    }    function eraseZone(Clock) {        Clock.ctx.clearRect(Clock.x - Clock.radius - netRadius, Clock.y - Clock.radius - netRadius, Clock.radius * 2 + netRadius * 2, Clock.radius * 2 + netRadius * 2);    }    this.step = function() {        clockInterval = setInterval(function(Clock) {            doStep[type](Clock);        }, freq, this);        if (autoDraw) {            drawInterval = setInterval(function(Clock) {                Clock.draw();            }, freq, this);        }    };    this.draw = function() {        this.ctx.save();        doDraw[type](this);        this.ctx.restore();    };    this.setEndCallBack = function(newCallBack) {        endCallback = newCallBack;    };     //clear the interval    this.stopEndCallBack = function(){        clearInterval(clockInterval);        clearInterval(drawInterval);    };     this.reset = function(params){        var keys= Object.keys(this.params);        var keys2= Object.keys(params);        for(var i = 0; i < keys.length; i++){            for (var j = 0; j < keys2.length; j++) {                if(keys2[j] == keys[i]){                    this.params[keys[i]] = params[keys2[j]]                    break                }            };        }        setInitialClock(this);    }}Clock.TYPE_CLOCKWISE_INCREMENT = 0;Clock.TYPE_CLOCKWISE_DECREMENT = 1;Clock.TYPE_COUNTERCLOCKWISE_INCREMENT = 2;Clock.TYPE_COUNTERCLOCKWISE_DECREMENT = 3;Clock.prototype.getGameTime = function() {    return Math.ceil(this.diff);};/** * @preserve * QUIZ * VERSION: 2.1 * JS * AUTHOR: Ian Duff * COPYRIGHT: Essemble Ltd * All code © 2015 Essemble Ltd. all rights reserved * This code is the property of Essemble Ltd and cannot be copied, reused or modified without prior permission */function Quiz (vars) {	//constructor	var scope = this;	this._screen = vars.element._screen;	this._container = vars.element._container;	this._questionContainer;		this._timeoutContainer;	this._oTimeoutElements = {};	this._scoreContainer;	this._arScoreElements = [];	this._timer = false;	//the question container will hold everything 	this._questionContainer = create({ type: "div", id: "questionContainer" });	this._container.appendChild(this._questionContainer);	//option container will contain the question options, buttons and any supporting elements	var optionContainer = create({ type: "div", id: "optionContainer" }); 	$(optionContainer).css("left",0);  	$(optionContainer).css("top",0); 	this._questionContainer.appendChild(optionContainer);		//feedback container	var fbContainer = create({ type: "div", id: "feedbackContainer" }); 	this._questionContainer.appendChild(fbContainer);	//create the timeout elements	this._timeoutContainer = create({ type: "div", id: "timeoutContainer" }); //timeout container 	$(this._timeoutContainer).hide();	this._screen.container().appendChild(this._timeoutContainer);	//create the score screen feedbacks (pass,fail);	this._scoreContainer = create({ type: "div", id: "scoreContainer" });; //score container	$(this._scoreContainer).hide();	this._screen._container.appendChild(this._scoreContainer);	MCQ.call(this,vars); //inherit the MCQ object	var timeout = $(this._xml).find("timeout");	var oTimeOut = {};	oTimeOut._xml = timeout;	oTimeOut._elements = [];	$(timeout).children().each(function(){		var el = new Element({screen:scope._screen, xml:this});		el._target = scope._timeoutContainer;		oTimeOut._elements.push(el)	});	this._oTimeoutElements = oTimeOut;		var score = $(this._xml).find("score");	this._masteryscore = score.attr("masteryscore") || 80;	$(score).find("fb").each(function(){		var fbObj = {};		fbObj._id = $(this).attr("id");		fbObj._xml = score;		fbObj._elements = [];		fbObj._event = null;		if($(this).attr("event")) fbObj._event = $(this).attr("event");		$(this).children().each(function(){			var elem = new Element({screen:scope._screen, xml:this});			elem._target = scope._scoreContainer;			fbObj._elements.push(elem);		})				scope._arScoreElements.push(fbObj);	});	//attach the timer if appropriate	var settings = $(this._xml).find("settings");	if(settings.attr("timer")) { this._timer = Boolean(settings.attr("timer").toLowerCase() === "true"); }	var timerx = settings.attr("timerx") || 0;	var timery = settings.attr("timery") || 0;	//the timer canvas 	var clockCanvas = create({ type: "canvas", id: "timer" });	$(clockCanvas).css("position","absolute");	$(clockCanvas).css("left",timerx +"px");	$(clockCanvas).css("top",timery+"px");	$(clockCanvas).attr("width",300);	$(clockCanvas).attr("height",300);	this._clockCanvas = clockCanvas;	var cont = clockCanvas.getContext("2d");	//change colours, width and radius here	if(this._timer){		this._timer = new Clock({ 			context 	: cont, 		  	type 		: Clock.TYPE_CLOCKWISE_INCREMENT,		  	time 		: scope.curQ()._time,		  	showText 	: true,		  	textColor 	: '#fff',		  	bodyColor   : '#f1ab43',		  	borderColor : '#fff',		  	radius 	    : 100,		  	bodyWidth   : 20,		  	borderWidth : 50,		  	autoDraw:true,		  	x:150,		  	y:150,		  	endCallBack : scope.timeout.bind(scope)		});	}}Quiz.prototype = {	//Quiz methods	makeQuestionObj:function(xml){		//override the MCQ class as we don't want to load the question immediately		//this is done on begin()		//for each question create a question object		//the object has an element array, option array and feedback array,		//question properties,		//question container,		//option container,		//feedback container,		//methods to return the current question elements, options and feedbacks by id.				var qObj = {};		qObj._id = xml.attr("id")  || "question" + this._arQs.length+1;		qObj._time = parseInt(xml.attr("time")) || 0;		qObj._xml = xml;		qObj._arElements = []; //stores all the option elements and supporting elements for this question		qObj._arOptions = []; //stores all option objects (a property of which is the option element) for this question		qObj._arFbs = []; //stores feedback objects for this question (pass, partial, fail)		qObj._radioMode = true;		qObj._bPassed = false;		qObj._event = null;		if(xml.attr("event")) qObj._event = xml.attr("event");		//option container will contain the question options, buttons and any supporting elements		qObj._optionContainer = get("optionContainer") //create({ type: "div", id: "optionContainer" }); 				//feedback container		qObj._fbContainer = get("feedbackContainer") //create({ type: "div", id: "feedbackContainer" }); 				qObj.getElementById = function(id){			var ret = null;			for (var i=0;i<this._arElements.length;i++){				if(this._arElements[i]._id == id){					ret = this._arElements[i];					break;				}			}			return ret;		}		qObj.getOptionById = function(id){			var ret = null;			for (var i=0;i<this._arOptions.length;i++){				if(this._arOptions[i]._id == id){					ret = this._arOptions[i];					break;				}			}			return ret;		}		qObj.getFeedbackById = function(id){			var ret = null;			for (var i=0;i<this._arFbs.length;i++){				if(this._arFbs[i]._id == id){					ret = this._arFbs[i];					break;				}			}			return ret;		}				//for each question create 3 arrays:		//qObj._arElements (contains options and supporting elements, including confirm and reset buttons)		//qObj._arOptions (contains option objects)		//qObj._arFbs (contains feedback objects)		var correctCount = 0;		var question = xml.children();//all the nodes in the question node		var scope = this;		$(xml).children().each(function(){			var nodeType = this.tagName;			switch(nodeType){				case "option":					var firstElement = $(this).children()[0];					var oOptionElement = new Element({screen:scope._screen, xml:firstElement});					oOptionElement._target = qObj._optionContainer;					qObj._arElements.push(oOptionElement);										//create an option object 					//this so we can loop thru just the options in each question					//properties include: correct, selected, element, (specific) feedback					//push to the qObj._arOptions array					var qOptionObj = {};					qOptionObj._id = oOptionElement._id;					qOptionObj._element = oOptionElement;					qOptionObj._correct = Boolean($(this).attr("correct").toLowerCase() == "true");					qOptionObj._selected = false;					qOptionObj._feedback = null;						//radio mode is when there is only one correct answer					//in radio mode only one option can be selected at a time					if(qOptionObj._correct) correctCount++;					if(correctCount > 1 || scope._forceMany) qObj._radioMode = false;					qObj._arOptions.push(qOptionObj);				break;								case "fb":					//create a feedback object					//properties are id (either option id or "pass","partial","fail")					//and an array of elements					//push to the qObj._arFbs array										var fbObj = {};					fbObj._id = $(this).attr("id");					fbObj._xml = $(this).children();					fbObj._elements = [];					fbObj._event = null;					if($(this).attr("event")) fbObj._event = $(this).attr("event");										$(this).children().each(function(){						var el = new Element({screen:scope._screen, xml:this });						fbObj._elements.push(el);					})										qObj._arFbs.push(fbObj);							break;								default:					//all other elements, e.g. buttons (confirm & reset), additional text, images, audio, video					var otherEl = new Element({screen:scope._screen, xml:this });					otherEl._target = qObj._optionContainer;					qObj._arElements.push(otherEl);				break;			}		});		scope._arQs.push(qObj);	},		init:function(){		//override mcq init function		//the first question is loaded by begin()		if(get("timerContainer")){			get("timerContainer").appendChild(this._clockCanvas);		} else {			this._screen._container.appendChild(this._clockCanvas);		}	},		begin:function(element){		this._iCurQ = 0;		this.loadQuestion(this._iCurQ);	},		loadQuestion:function(id){		var q = this._arQs[id];		if(q._event) this._screen.doClickEventById(q._event);		//reset any selected options		for (var i=0;i<q._arOptions.length;i++) {			q._arOptions[i]._selected = false;		}		//target the questions option container		for (var i=0;i<q._arElements.length;i++){			q._arElements[i]._target = get("optionContainer");		}		//load the options and supporting elements within the questions option container		//start the timer when batch load is complete		var optionLoader = new ElementLoader({screen:this._screen, elements:q._arElements, onAnimsComplete:"startTimer", onCompleteScope:this});		optionLoader.load();	},	loadNextQuestion:function(element){		this.clearQuestionContainer();		this.clearTimeoutContainer();				if(this._iCurQ < this._arQs.length-1) {			this._iCurQ++; 			this.loadQuestion(this._iCurQ);		} else {			this.showScore();		}	},	loadPreviousQuestion:function(element){		this.clearQuestionContainer();		this.clearTimeoutContainer();				if(this._iCurQ != 0) {			this._iCurQ--; 			this.loadQuestion(this._iCurQ);		}	},	submit:function(element){		var q = this._arQs[this._iCurQ];		q._bPassed = false;		var optionCorrectCount = 0;		var userCorrectCount = 0;		var allCorrect = false;		var selectedOptionPos = null; //remember the (last) selected option in case of specific feedback		var count = 0;		var bPartial = false;		//stop & hide the timer		if(this._timer){ 			this.stopTimer(); 			$(get("timer")).fadeOut(500);		}		//disable confirm, enable reset		var confirmBtn = q.getElementById("submitBtn");		if(confirmBtn) confirmBtn.disableBtn();				var resetBtn = q.getElementById("resetBtn");		if(resetBtn) resetBtn.enableBtn();				//disable options and work out which ones answered correctly		for (var i=0;i<q._arOptions.length;i++) {			q._arOptions[i]._element.disable();			if(q._arOptions[i]._correct) { optionCorrectCount++; };			if(q._arOptions[i]._selected && q._arOptions[i]._correct) { userCorrectCount++; bPartial = true; };			if(q._arOptions[i]._selected && !q._arOptions[i]._correct) userCorrectCount--;			if(q._arOptions[i]._selected) {				selectedOptionPos = (count+1);			}			count++;		}				//does the selected option have specific feedback? (returns null if not)		var spFb = q.getFeedbackById(selectedOptionPos);		if(userCorrectCount == optionCorrectCount){			//all correct			spFb ? this._fb = spFb : this._fb = q.getFeedbackById("pass");			q._bPassed = true;	//flag question as passed		} else if (bPartial){			//some correct			spFb ? this._fb = spFb : this._fb = q.getFeedbackById("partial");		} else {			//none correct			spFb ? this._fb = spFb : this._fb = q.getFeedbackById("fail");		}		//target the feedback container		for (var i=0;i<this._fb._elements.length;i++) {			this._fb._elements[i]._target = q._fbContainer;		}				//send a copy of the feedback array to the element loader		//this is so that if the loader array length is increased by box nested elements		//the copied array is updated not the orginal array		var fbCopy = [];		fbCopy = this._fb._elements.slice();				//load the feedback elements		var fbLoader = new ElementLoader({screen:this._screen, elements:fbCopy, onAnimsComplete:"scrollToBottom", onCompleteScope:this});		fbLoader.load();				//fire any events defined for the feedback		if(this._fb._event) {			var str = this._fb._event.split(" ").join("").toString();			var arSplit = str.split(",")			for(var i=0;i<arSplit.length;i++){				this._screen.doClickEventById(arSplit[i],null);			}		}	},	scrollToBottom:function(){		// $('html, body').animate({ 		//    scrollTop: $(document).height()-$(window).height()}, 		//    1000, 		//    "easeOutQuint"		// );	},		timeout:function(){		//empty current question		this.clearQuestionContainer();				//stop & hide timer		if(this._timer){ 			this.stopTimer();			$(get("timer")).hide();		}		//send a copy of the feedback array to the element loader		//this is so that if the loader array length is increased by box nested elements		//the copied array is updated not the orginal array		var elCopy = [];		elCopy = this._oTimeoutElements._elements.slice();		//load the timeout elements		var elementLoader = new ElementLoader({screen:this._screen, elements:elCopy});		elementLoader.load();				//fire any events that may be tied to the feedback		if(xmlAttrStr(this._oTimeoutElements._xml,"event")) {			this._screen.doClickEventById(this._oTimeoutElements._xml.attr("event"), null);		}		$(this._timeoutContainer).show();	},	getScore:function(asPercentage){		var score = 0;		for(var i=0;i<this._arQs.length;i++){			if(this._arQs[i]._bPassed) score++;		}		var perc = Math.round((score/this._arQs.length) *100);		if(asPercentage){			return perc;		} else {			return score;		}	},		showScore:function(){		//work out the score		var userPercentage = this.getScore(true);		var oScoreFb = {};		//get the appropriate feedback		if(userPercentage >= this._masteryscore) {			oScoreFb = this.getScoreFeedbackById("pass");		} else {			oScoreFb = this.getScoreFeedbackById("fail");		}		//hide the timer		if(this._timer){			$(get("timer")).fadeOut(500);		}				//load feedback elements into an array		//replace the [score] reserved word 		var arScoreElements = [];			var scope = this;			$(oScoreFb._elements).each(function () {			var copyNode = this._xml[0].cloneNode(true);			scope.replaceXML(copyNode,userPercentage);//recursively checks for box nested elements			var element = new Element({screen:scope._screen, xml:copyNode});			element._target = scope._scoreContainer;			arScoreElements.push(element);		})				//send a copy of the feedback array to the element loader		//this is so that if the loader array length is increased by box nested elements		//the copied array is updated not the orginal array		var fbCopy = [];		fbCopy = arScoreElements.slice();		arScoreElements = [];		//load the score elements		var elementLoader = new ElementLoader({screen:this._screen, elements:fbCopy});		elementLoader.load();				//fire any events that may be tied to the feedback		if(oScoreFb._event){			this._screen.doClickEventById(oScoreFb._event, null);		}		$(this._scoreContainer).show();	},	replaceXML:function(copyNode,userPercentage){		if($(copyNode).children().length > 0){			for(var i=0;i<$(copyNode).children().length; i++){				var nestedXML = $(copyNode).children()[i];				this.replaceXML(nestedXML,userPercentage)			}		} else {			//replaces the value of the original xml node			var xmlNode = replaceXMLStr(copyNode,"[score]",userPercentage); 			var xmlNode = replaceXMLStr(copyNode,"[passed]",this.getScore(false));			var xmlNode = replaceXMLStr(copyNode,"[total]",this._arQs.length);  		}	},	select:function(element){		//select an option		var q = this.curQ();		var selectedOption = q.getOptionById(element._id);				if(q._radioMode){			element.disable();			for (var i=0; i<q._arOptions.length;i++){				if(q._arOptions[i]._element != element){					q._arOptions[i]._element.enable();					q._arOptions[i]._selected = false;				} 			}			selectedOption._selected = true;		} else {			if(selectedOption._selected){				//deselect				selectedOption._selected = false;				element.enable();				element.rollout();				$(element._container).on('mouseenter', element.mouseOverHandler.bind(element));				$(element._container).on('mouseleave', element.mouseOutHandler.bind(element));			} else {				//select				//disable rollover events				selectedOption._selected = true;				$(element._container).off('mouseenter');				$(element._container).off('mouseleave');			}		}		//if any of the options have been selected, enable the confirm btn, otherwise disable it		var bEnable = false;		for (var i=0; i<q._arOptions.length;i++) {			if(q._arOptions[i]._selected) bEnable = true;		}				var confirmBtn = q.getElementById("submitBtn");		if(!confirmBtn) confirmBtn = this._screen.getElementById("submitBtn");		if(confirmBtn){			bEnable ? confirmBtn.enableBtn() : confirmBtn.disableBtn();		}	},		restart:function(element){		this.clearTimeoutContainer();		this.clearScoreContainer();		this.clearQuestionContainer();		this._iCurQ = 0;		this.loadQuestion(this._iCurQ);	},		startTimer:function(){		if(this._timer){			$(get("timer")).show();			this._timer.init();			var qTime = this._arQs[this._iCurQ]._time;			this._timer.time = qTime;			this._timer.step();//start the timer		}	},		stopTimer:function(){		if(this._timer){			this._timer.stopEndCallBack();			//$(get("timer")).remove();		}	},	clearTimeoutContainer:function(){		this._timeoutContainer.innerHTML = "";		$(this._timeoutContainer).css("display","none");	},		clearScoreContainer:function(){		this._scoreContainer.innerHTML = "";		$(this._scoreContainer).css("display","none");	},		getScoreFeedbackById:function(id){		for (var i=0;i<this._arScoreElements.length;i++){			if(this._arScoreElements[i]._id == id){				return this._arScoreElements[i];				break;			}		}	}} //end prototype objectextend(MCQ, Quiz); //inherit the MCQ object and its prototype methods	
//# sourceMappingURL=frontend.js.map
