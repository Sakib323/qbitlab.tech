(()=>{var e,t={5622:(e,t,a)=>{"use strict";const l=window.wp.element,n=window.wp.i18n,r=window.wp.components,i=window.wp.blocks;var o=a(4184),c=a.n(o);const s=window.lodash,d=window.wp.data,u=window.wp.blockEditor,m=window.wp.compose,g=window.wp.hooks,p=e=>{let{tabs:t=[]}=e;const[{currentTab:a},n]=(0,l.useState)({currentTab:!1});return(0,l.createElement)("div",{className:"gutenify-accordion-wrapper"},t.map((e=>{const t=e.label,i=a===e.name;let o="gutenify-accordion-item";return o+=i?" gutenify-accordion-item-active":"",(0,l.createElement)("div",{className:o,key:`gutenify-accordion-item-${e.name}`},(0,l.createElement)("button",{onClick:()=>{n({currentTab:a===e.name?"":e.name})},className:"gutenify-accordion-item-heading"},(0,l.createElement)("div",{className:"gutenify-accordion-item-heading-arrow"},(0,l.createElement)(r.Icon,{icon:i?"arrow-down-alt2":"arrow-right-alt2"})),(0,l.createElement)("div",{className:"gutenify-accordion-item-label"},(0,l.createElement)(t,null))),(0,l.createElement)("div",{className:"gutenify-accordion-item-content"}," ",e.cb()))})))},h=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":2,"name":"gutenify/gallery-carousel","category":"gutenify","title":"Gallery Carousel","version":"2","attributes":{"blockClientId":{"type":"string","default":""},"blockAdvanceOptions":{"type":"object","default":{"buttonBorderWidth":1,"buttonBorderRadius":0}},"images":{"type":"array","default":[]},"imagesData":{"type":"object","default":{}},"columns":{"type":"number","default":1},"spaceBetween":{"type":"number","default":10},"hasNavigation":{"type":"boolean","default":true},"hasPagination":{"type":"boolean","default":true},"isAutoplay":{"type":"boolean","default":false},"layout":{"type":"string","default":"layout-1"}},"supports":{"html":false,"align":["center","wide","full"],"inserter":false},"editorScript":["gutenify--gallery-carousel","gutenify-swiper"],"editorStyle":["gutenify--gallery-carousel--editor"],"style":["gutenify--gallery-carousel--frontend","gutenify-swiper"],"viewScript":["gutenify-common-scripts-slider","gutenify-swiper"]}'),{name:v}=h,f={hookPrefix:"gallery-carousel",blockId:v.replace("/","--"),layouts:[{name:"layout-1",label:"Layout 1",imageAlign:"center",titleAlign:"center",ratingAlign:"center"},{name:"layout-2",label:"Layout 2",imageAlign:"center",titleAlign:"left",ratingAlign:"left"},{name:"layout-3",label:"Layout 3",imageAlign:"center",titleAlign:"right",ratingAlign:"right"}]};var w;const y=null!==(w=window)&&void 0!==w&&w._gutenify_vars?window._gutenify_vars:{},{is_pro_activated:b,pro_account_url:E,pro_license_status:C,title:_,prefix:k,slug:A,authorWebSite:x,authorDemoWebSite:$,authorWebSiteProPage:M,defaultTheme:H,authorWebSiteSupport:L,plugin_directory_url:N,brand_color:S,plugin_main_version:V,documentationsURL:Z,pro_title:B,active_blocks:T,plugin_main_camel_case_name:P}=y,G=(null!=y&&y.siteUrl?y.siteUrl:y.site_url,(0,n.sprintf)("Want to enjoy all feature of blocks? Checkout %1$s%2$s%3$s.",'<a href="'+M+'" target="_blank">',B,"</a>"),{pluginMainSlug:"gutenify",pluginMainCamelCaseName:P,pluginMainFunctionPrefix:"gutenify"}),{hookPrefix:O,layouts:z,blockId:F}=f,{pluginMainSlug:I,pluginMainFunctionPrefix:R}=G,{plugin_directory_url:W}=window[`_${R}_vars`];(0,g.addFilter)(`${I}--inspector-controls--${F}--content`,`${I}--inspector-controls--${F}--content--slider-layouts`,((e,t)=>{const{attributes:a,setAttributes:i}=t,{layout:o,columns:c,hasNavigation:s,hasPagination:d,spaceBetween:u}=a;return[...e,(0,l.createElement)(l.Fragment,{key:`gutenify-block-${F}-options-tab-content-basic`},(0,l.createElement)(p,{tabs:[{name:"slider-options",initialOpen:!0,label:()=>(0,n.__)("Slider"),cb:()=>(0,l.createElement)(l.Fragment,null,z&&(0,l.createElement)("div",{className:"gutenify-template-browser"},(0,l.createElement)("h2",null,"Templates"),(0,l.createElement)("ul",null,z.map((e=>{let t="gutenify-template-browser-item";return o===e.name&&(t+=" gutenify-template-browser-item-active"),(0,l.createElement)("li",{className:t,key:e.name},(0,l.createElement)("button",{className:"gutenify-template-browser-selector",onClick:()=>{const t={layout:e.name,socialIconAlign:e.socialIconAlign,imageAlign:e.imageAlign,titleAlign:e.titleAlign};i(t)}},(0,l.createElement)("img",{src:`${W}/assets/images/gallery-carousel-layouts/${e.name}.png`,alt:e.name}),(0,l.createElement)("small",null,e.label)))})))),(0,l.createElement)(r.ToggleControl,{label:(0,n.__)("Enable Navigation","gutenify"),checked:s,help:s?(0,n.__)("Showing slider navigation.","gutenify"):(0,n.__)("Toggle to enable slider navigation.","gutenify"),onChange:()=>i({hasNavigation:!s})}),(0,l.createElement)(r.ToggleControl,{label:(0,n.__)("Enable Pagination","gutenify"),checked:d,help:d?(0,n.__)("Showing slider pagination.","gutenify"):(0,n.__)("Toggle to enable slider pagination.","gutenify"),onChange:()=>i({hasPagination:!d})}),(0,l.createElement)("hr",null),(0,l.createElement)(r.RangeControl,{label:(0,n.__)("Columns"),value:c,onChange:e=>{i({columns:e})},min:1,max:(0,g.applyFilters)(`${I}--${F}--max-columns`,3),step:1}),(0,l.createElement)(r.RangeControl,{label:(0,n.__)("Slider space"),value:u,onChange:e=>{i({spaceBetween:e})},min:0,max:100,step:1,help:(0,n.__)("Space between each slide.")}),(0,g.applyFilters)(`gutenify--${O}--inspector--tab-content--slider`,[],t))}]}))]}));const{pluginMainSlug:j}=G,{hookPrefix:D}=f,q=(0,m.compose)([(0,d.withDispatch)(((e,t)=>{const{selectBlock:a}=e("core/block-editor");return{selectBlock:()=>{a(t.clientId)}}}))])((e=>{const{isSelected:t,className:a,attributes:r}=e,{images:i,imagesData:o,columns:d,hasPagination:m,hasNavigation:p,spaceBetween:v,blockClientId:f,layout:w}=r,y=(0,l.useRef)();let[b,E]=(0,l.useState)(null);(0,l.useEffect)((()=>{const{ownerDocument:e}=y.current,t={allowTouchMove:!1,slidesPerView:d,pagination:{el:e.querySelector(`.${j}-section-${f} .swiper-pagination`),clickable:!0},navigation:{nextEl:e.querySelector(`.${j}-section-${f} .swiper-button-next`),prevEl:e.querySelector(`.${j}-section-${f} .swiper-button-prev`)},scrollbar:{el:".swiper-scrollbar"},spaceBetween:v},a=new Swiper(e.querySelector(`.${j}-section-${f}`),t);b=a,E(a)}),[d,v,m,p]),(0,l.useEffect)((()=>{void 0!==b.$el&&b.update()}),[d,v,m,p]);const C=(e,t)=>{var a;const l=(0,s.find)(t,(t=>parseInt(null==t?void 0:t.id)===(null==e?void 0:e.id)));return Array.isArray(null==l?void 0:l.caption)?null==l||null===(a=l.caption)||void 0===a?void 0:a[0]:(null==l?void 0:l.caption)||(null==e?void 0:e.caption)||""},_=(e,t)=>{const a=(0,s.find)(t,(t=>parseInt(null==t?void 0:t.id)===(null==e?void 0:e.id)));return(null==a?void 0:a.imgLink)||(null==e?void 0:e.imgLink)||""},k=t=>(e.setAttributes({imagesData:{...o}}),t),A=(t,a,l)=>{(0,s.has)(o,t)||(o[t]={}),o[t][a]=l,e.setAttributes({imagesData:{...o}})};let x=[a,`gutenify-section-${f}`,`gutenify--${D}--${w}`,`${h.name.replace(/\//gm,"-")}-version-${h.version}`,"swiper-container"];x=c()((0,g.applyFilters)(`gutenify--${D}--wrapper-class`,x,e));const $=!!i.length,M=!$&&(0,n.__)("Gallery Carousel"),H=c()("gutenify--figure",{}),L=(0,u.useBlockProps)({className:x,ref:y});return(0,l.createElement)(l.Fragment,null,(0,l.createElement)("div",L,$&&(0,l.createElement)("div",{className:"swiper-wrapper"},i.map((e=>(0,l.createElement)("div",{className:"gutenify-gallery-carousel-item swiper-slide",key:e.id||e.url},(0,l.createElement)("div",{className:"gutenify-slider-image-wrapper"},(0,l.createElement)("div",{className:"gutenify-slider-content-image"},(0,l.createElement)("figure",{className:H},(0,l.createElement)("img",{src:e.url,alt:e.alt,"data-link":e.link,"data-id":e.id,className:e.id?`wp-image-${e.id}`:null})))),(0,l.createElement)("div",{className:"gutenify-slider-content-wrapper"},(0,l.createElement)("div",{className:"gutenify-slider-content-inner"},(0,l.createElement)(u.RichText,{tagName:"h2",value:(0,s.has)(o[e.id],"title")?o[e.id].title:"",allowedFormats:["core/bold","core/italic","core/link"],onChange:t=>{A(e.id,"title",t)},placeholder:(0,n.__)("Heading…"),className:"gutenify-slider-title"}),(0,l.createElement)(u.RichText,{tagName:"h3",value:(0,s.has)(o[e.id],"subTitle")?o[e.id].subTitle:"",allowedFormats:["core/bold","core/italic","core/link"],onChange:t=>{A(e.id,"subTitle",t)},placeholder:(0,n.__)("Sub Heading…"),className:"gutenify-slider-sub-title"}),(0,l.createElement)("div",{className:"gutenify-slider-content-inner-wrapper"},(0,l.createElement)("div",{className:"gutenify-slider-content clear-fix"},(0,l.createElement)(u.RichText,{tagName:"p",value:(0,s.has)(o[e.id],"description")?o[e.id].description:"",allowedFormats:["core/bold","core/italic","core/link"],onChange:t=>{A(e.id,"description",t)},placeholder:(0,n.__)("Content…")}))))))))),m&&(0,l.createElement)("div",{className:"swiper-pagination"}),p&&(0,l.createElement)("div",{className:"navigation-wrap"},(0,l.createElement)("div",{className:"swiper-button-prev"}),(0,l.createElement)("div",{className:"swiper-button-next"}))),(t||!$)&&(0,l.createElement)(l.Fragment,null,(0,l.createElement)(u.MediaPlaceholder,{addToGallery:$,isAppender:$,className:"gutenify-gallery-figure",disableMediaButtons:$&&!t,labels:{title:M,instructions:!$&&(0,n.__)("Drag images, upload new ones or select files from your library.","coblocks")},onSelect:t=>{e.setAttributes({images:t.map((e=>({...k(e),caption:C(e,i),imgLink:_(e,i)})))})},accept:"image/*",allowedTypes:["image"],multiple:!0,value:$?i:void 0,onError:()=>{}})))})),U=window.wp.primitives,J=((0,l.createElement)(U.SVG,{fill:"none","view-box":"0 0 24 24",xmlns:"http://www.w3.org/2000/svg"},(0,l.createElement)(U.G,{fill:S},(0,l.createElement)(U.Path,{d:"M19 6.5H5c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-7c0-1.1-.9-2-2-2zm.5 9c0 .3-.2.5-.5.5H5c-.3 0-.5-.2-.5-.5v-7c0-.3.2-.5.5-.5h14c.3 0 .5.2.5.5v7zM8 12.8h8v-1.5H8v1.5z"}))),(0,l.createElement)(U.SVG,{width:"24",height:"24",fill:"none",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg",role:"img","aria-hidden":"true",focusable:"false"},(0,l.createElement)(U.Rect,{height:"14.5",rx:".875",stroke:S,strokeWidth:"1.5",width:"14.5",x:"4.75",y:"4.75",fill:"none"}),(0,l.createElement)(U.Path,{d:"m5.06667 14.6666 3.9619-2.1334 2.97143 1.4222 3.4667-2.4888 3.4666 2.4888",stroke:S,strokeLinejoin:"round",strokeWidth:"1.5",fill:"none"}),(0,l.createElement)(U.G,{fill:S},(0,l.createElement)(U.Path,{d:"m23 18c-.8284 0-1.5-.6716-1.5-1.5v-9c0-.82843.6716-1.5 1.5-1.5z"}),(0,l.createElement)(U.Path,{d:"m1 6c.82843 0 1.5.67157 1.5 1.5v9c0 .8284-.67157 1.5-1.500001 1.5z"})))),{blockId:K}=((0,l.createElement)(U.SVG,{width:"27",height:"13",viewBox:"0 0 27 13",fill:"none",xmlns:"http://www.w3.org/2000/svg"},(0,l.createElement)(U.Rect,{width:"27",height:"13",rx:"6.5",fill:"#05A015"}),(0,l.createElement)(U.Path,{d:"M6.57812 6.99609L6.22656 9H5.08203L6.07031 3.3125L8.0625 3.31641C8.67708 3.31641 9.16016 3.48698 9.51172 3.82812C9.86328 4.16927 10.0169 4.61458 9.97266 5.16406C9.93099 5.72135 9.69792 6.16667 9.27344 6.5C8.85156 6.83333 8.3125 7 7.65625 7L6.57812 6.99609ZM6.73828 6.04688L7.69141 6.05469C7.9987 6.05469 8.25391 5.97526 8.45703 5.81641C8.66016 5.65755 8.78125 5.44271 8.82031 5.17188C8.85938 4.90104 8.8151 4.6849 8.6875 4.52344C8.5625 4.36198 8.3763 4.27604 8.12891 4.26562L7.05078 4.26172L6.73828 6.04688ZM12.5664 6.91797H11.6367L11.2734 9H10.1289L11.1172 3.3125L13 3.31641C13.6302 3.31641 14.1146 3.46484 14.4531 3.76172C14.7943 4.05859 14.9453 4.47135 14.9062 5C14.8516 5.78125 14.4349 6.32422 13.6562 6.62891L14.457 8.9375V9H13.2383L12.5664 6.91797ZM11.8008 5.96875L12.6523 5.97656C12.9544 5.97135 13.2031 5.89062 13.3984 5.73438C13.5964 5.57552 13.7148 5.36068 13.7539 5.08984C13.7904 4.83724 13.75 4.63932 13.6328 4.49609C13.5156 4.35286 13.3294 4.27604 13.0742 4.26562L12.0977 4.26172L11.8008 5.96875ZM17.4062 9.07812C17.0286 9.07031 16.6953 8.98177 16.4062 8.8125C16.1198 8.64062 15.8919 8.39453 15.7227 8.07422C15.556 7.7513 15.4596 7.38151 15.4336 6.96484C15.4049 6.53776 15.4505 6.08203 15.5703 5.59766C15.6901 5.11328 15.8828 4.6875 16.1484 4.32031C16.4141 3.95312 16.7253 3.67839 17.082 3.49609C17.4414 3.3138 17.8294 3.22656 18.2461 3.23438C18.6289 3.24219 18.9635 3.33333 19.25 3.50781C19.5365 3.67969 19.7617 3.92839 19.9258 4.25391C20.0898 4.57682 20.1836 4.94401 20.207 5.35547C20.2331 5.8138 20.1836 6.28516 20.0586 6.76953C19.9336 7.25391 19.7396 7.67318 19.4766 8.02734C19.2135 8.38151 18.9049 8.64714 18.5508 8.82422C18.1992 9.0013 17.8177 9.08594 17.4062 9.07812ZM19.0273 6L19.0586 5.62891C19.0846 5.16536 19.0221 4.8138 18.8711 4.57422C18.7227 4.33464 18.4961 4.20964 18.1914 4.19922C17.7148 4.18359 17.3359 4.39453 17.0547 4.83203C16.776 5.26953 16.6185 5.88151 16.582 6.66797C16.556 7.12891 16.6172 7.48438 16.7656 7.73438C16.9141 7.98177 17.1445 8.11068 17.457 8.12109C17.8659 8.13932 18.2044 7.98047 18.4727 7.64453C18.7409 7.30599 18.9167 6.82812 19 6.21094L19.0273 6Z",fill:"white"})),(0,l.createElement)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",xmlns:"http://www.w3.org/2000/svg",role:"img","aria-hidden":"true",focusable:"false"},(0,l.createElement)("path",{d:"M18 4h-7c-1.1 0-2 .9-2 2v3H6c-1.1 0-2 .9-2 2v7c0 1.1.9 2 2 2h7c1.1 0 2-.9 2-2v-3h3c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-4.5 14c0 .3-.2.5-.5.5H6c-.3 0-.5-.2-.5-.5v-7c0-.3.2-.5.5-.5h3V13c0 1.1.9 2 2 2h2.5v3zm0-4.5H11c-.3 0-.5-.2-.5-.5v-2.5H13c.3 0 .5.2.5.5v2.5zm5-.5c0 .3-.2.5-.5.5h-3V11c0-1.1-.9-2-2-2h-2.5V6c0-.3.2-.5.5-.5h7c.3 0 .5.2.5.5v7z",fill:S})),(0,l.createElement)("svg",{version:"1.1",id:"Layer_1",xmlns:"http://www.w3.org/2000/svg",x:"0px",y:"0px",viewBox:"0 0 1080 1080",xmlSpace:"preserve"},(0,l.createElement)("g",null,(0,l.createElement)("g",null,(0,l.createElement)("path",{className:"st0",d:"M828.5,552.9c-6.8,152.9-133.3,275.1-287.9,275.1c-158.9,0-288.2-129.3-288.2-288.2 c0-150.6,116.2-274.5,263.5-287.1V0.4C229.1,13.2,0.5,249.9,0.5,539.9c0,298.2,241.7,540.1,540.1,540.1 c293.9,0,533-234.8,539.8-527H828.5V552.9z"}),(0,l.createElement)("rect",{x:"518.9",y:"254.6",className:"st1",width:"309.8",height:"298.2"})))),(0,l.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 278.799 278.799"},(0,l.createElement)("g",null,(0,l.createElement)("path",{d:"M265.54,0H13.259C5.939,0,0.003,5.936,0.003,13.256v252.287c0,7.32,5.936,13.256,13.256,13.256H265.54 c7.318,0,13.256-5.936,13.256-13.256V13.255C278.796,5.935,272.86,0,265.54,0z M252.284,252.287H26.515V26.511h225.769V252.287z",fill:S}))),(0,l.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"},(0,l.createElement)("rect",{x:"0",fill:"none",width:"20",height:"20"}),(0,l.createElement)("g",null,(0,l.createElement)("path",{d:"M2.25 1h15.5c.69 0 1.25.56 1.25 1.25v15.5c0 .69-.56 1.25-1.25 1.25H2.25C1.56 19 1 18.44 1 17.75V2.25C1 1.56 1.56 1 2.25 1zM17 17V3H3v14h14zM10 6c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm3 5s0-6 3-6v10c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V8c2 0 3 4 3 4s1-3 3-3 3 2 3 2z",fill:S}))),(0,l.createElement)("svg",{id:"a764fa4e-cc3b-472f-ad43-7e74fc450527","data-name":"Layer 2",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,l.createElement)("path",{d:"M3.49,19.54H9.1l2.47,4.21a.49.49,0,0,0,.86,0l2.47-4.21h5.61a2.22,2.22,0,0,0,2.22-2.23V2.23A2.22,2.22,0,0,0,20.51,0h-17A2.22,2.22,0,0,0,1.27,2.23V17.31A2.22,2.22,0,0,0,3.49,19.54ZM2.27,2.23A1.23,1.23,0,0,1,3.49,1h17a1.23,1.23,0,0,1,1.22,1.23V17.31a1.23,1.23,0,0,1-1.22,1.23h-5.9a.5.5,0,0,0-.43.24L12,22.51,9.82,18.78a.5.5,0,0,0-.43-.24H3.49a1.23,1.23,0,0,1-1.22-1.23Z",fill:S}),(0,l.createElement)("path",{d:"M8.31,11a.64.64,0,0,1,.18.57L8,14.65a.64.64,0,0,0,.93.68l2.81-1.48a.64.64,0,0,1,.6,0l2.81,1.48a.64.64,0,0,0,.93-.68l-.53-3.13a.64.64,0,0,1,.18-.57L18,8.74a.64.64,0,0,0-.35-1.1l-3.14-.46A.66.66,0,0,1,14,6.83L12.58,4a.65.65,0,0,0-1.16,0L10,6.83a.66.66,0,0,1-.49.35l-3.14.46A.64.64,0,0,0,6,8.74Z",fill:S})),(0,l.createElement)("svg",{id:"af96b2d0-e766-45ff-a399-fea356ead648","data-name":"Layer 2",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,l.createElement)("path",{d:"M10.84,9.71H4.26a.5.5,0,0,0-.5.5V11.9a.5.5,0,0,0,1,0V10.71H7.05V18H6.28a.5.5,0,0,0-.5.5.51.51,0,0,0,.5.5H8.82a.51.51,0,0,0,.5-.5.5.5,0,0,0-.5-.5H8.05V10.71h2.29V11.9a.5.5,0,1,0,1,0V10.21A.5.5,0,0,0,10.84,9.71Z",fill:S}),(0,l.createElement)("path",{d:"M19.74,10H14.06a.5.5,0,0,0-.5.5.5.5,0,0,0,.5.5h5.68a.5.5,0,0,0,.5-.5A.5.5,0,0,0,19.74,10Z",fill:S}),(0,l.createElement)("path",{d:"M19.74,17.72H14.06a.5.5,0,0,0,0,1h5.68a.5.5,0,0,0,0-1Z",fill:S}),(0,l.createElement)("path",{d:"M19.74,13.84H14.06a.5.5,0,0,0-.5.5.5.5,0,0,0,.5.5h5.68a.5.5,0,0,0,.5-.5A.5.5,0,0,0,19.74,13.84Z",fill:S}),(0,l.createElement)("path",{d:"M21.58,0H2.42A2.43,2.43,0,0,0,0,2.38V21.53A2.43,2.43,0,0,0,2.42,24H21.58A2.43,2.43,0,0,0,24,21.53V2.38A2.43,2.43,0,0,0,21.58,0ZM2.42,1H21.58A1.43,1.43,0,0,1,23,2.38V4.54H1V2.38A1.43,1.43,0,0,1,2.42,1ZM21.58,23H2.42A1.43,1.43,0,0,1,1,21.53v-16H23v16A1.43,1.43,0,0,1,21.58,23Z",fill:S})),(0,l.createElement)("svg",{id:"b9750429-17f3-433d-9161-079c88c0d998","data-name":"Layer 2",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,l.createElement)("path",{d:"M9.71,9.15h4.58a.5.5,0,0,0,.5-.5.5.5,0,0,0-.5-.5H9.71a.5.5,0,0,0-.5.5A.5.5,0,0,0,9.71,9.15Z",fill:S}),(0,l.createElement)("path",{d:"M17.63,10.72H6.37a.5.5,0,0,0-.5.5.5.5,0,0,0,.5.5H17.63a.5.5,0,0,0,.5-.5A.5.5,0,0,0,17.63,10.72Z",fill:S}),(0,l.createElement)("path",{d:"M17.63,13.29H6.37a.5.5,0,0,0-.5.5.5.5,0,0,0,.5.5H17.63a.5.5,0,0,0,.5-.5A.5.5,0,0,0,17.63,13.29Z",fill:S}),(0,l.createElement)("path",{d:"M15.94,15.87H8.06a.5.5,0,0,0-.5.5v2.8a.5.5,0,0,0,.5.5h7.88a.5.5,0,0,0,.5-.5v-2.8A.5.5,0,0,0,15.94,15.87Zm-.5,2.8H8.56v-1.8h6.88Z",fill:S}),(0,l.createElement)("path",{d:"M21.58,0H2.42A2.43,2.43,0,0,0,0,2.38V21.53A2.43,2.43,0,0,0,2.42,24H21.58A2.43,2.43,0,0,0,24,21.53V2.38A2.43,2.43,0,0,0,21.58,0ZM2.42,1H21.58A1.43,1.43,0,0,1,23,2.38V4.54H1V2.38A1.43,1.43,0,0,1,2.42,1ZM21.58,23H2.42A1.43,1.43,0,0,1,1,21.53v-16H23v16A1.43,1.43,0,0,1,21.58,23Z",fill:S})),(0,l.createElement)("svg",{id:"a7f22ee9-1614-475a-8b5a-2a4b05234844","data-name":"Layer 2",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,l.createElement)("path",{d:"M12,0A12,12,0,1,0,24,12,12,12,0,0,0,12,0Zm0,23A11,11,0,1,1,23,12,11,11,0,0,1,12,23Z",fill:S}),(0,l.createElement)("path",{d:"M17.61,10.12l-3.14-.45A.67.67,0,0,1,14,9.31l-1.4-2.84a.65.65,0,0,0-1.16,0L10,9.31a.67.67,0,0,1-.49.36l-3.14.45A.64.64,0,0,0,6,11.22l2.27,2.22a.64.64,0,0,1,.18.57L8,17.14a.64.64,0,0,0,.93.67l2.81-1.47a.64.64,0,0,1,.6,0l2.81,1.47a.64.64,0,0,0,.93-.67L15.51,14a.64.64,0,0,1,.18-.57L18,11.22A.64.64,0,0,0,17.61,10.12Z",fill:S})),(0,l.createElement)("svg",{id:"a1a34775-0c0f-439f-9b3d-b3905e6f0449","data-name":"Layer 2",xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 24 24"},(0,l.createElement)("path",{d:"M23.37,4.36l-7.54,2-2.62-.7V5.6a5,5,0,1,0-10.09,0s0,.05,0,.08L.37,6.41A.5.5,0,0,0,0,6.9V23a.47.47,0,0,0,.2.39.46.46,0,0,0,.3.11l.13,0,7.54-2,7.53,2,.13,0,.13,0,7.67-2.05A.5.5,0,0,0,24,20.9v-16a.51.51,0,0,0-.63-.49ZM8.17,1.55a4.05,4.05,0,0,1,4,4.05c0,1.73-2.64,5.33-4,7.05-1.41-1.72-4-5.32-4-7A4.06,4.06,0,0,1,8.17,1.55ZM1,7.28l2.3-.62c.75,2.54,3.65,6.11,4.37,7v6.89L1,22.29Zm7.67,6.34c.71-.85,3.62-4.42,4.36-7l2.3.62v15L8.67,20.51ZM23,20.51l-6.67,1.78v-15L23,5.5Z",fill:S}),(0,l.createElement)("path",{d:"M10.74,5.6A2.57,2.57,0,1,0,8.17,8.17,2.58,2.58,0,0,0,10.74,5.6ZM6.6,5.6A1.57,1.57,0,1,1,8.17,7.17,1.57,1.57,0,0,1,6.6,5.6Z",fill:S})),f),{pluginMainSlug:Q}=G;(0,g.addFilter)(`${Q}--inline-styles--${K}`,`${Q}--inline-styles--${K}--button`,(function(e,t){let a=arguments.length>2&&void 0!==arguments[2]&&arguments[2];const{blockAdvanceOptions:l}=t.attributes,{innerBlock:n}=l;a=a||`.gutenify-section-${t.clientId} .gutenify-gallery-carousel-item`;let r="";r+=(0,s.has)(n,"textColor")&&!(0,s.isEmpty)(n.textColor)?`color: ${n.textColor};`:"",r+=(0,s.has)(n,"backgroundColor")&&!(0,s.isEmpty)(n.backgroundColor)?`background: ${n.backgroundColor};`:"",(0,s.has)(n,"backgroundGradient")&&!(0,s.isEmpty)(n.backgroundGradient)&&(r+=`background: ${n.backgroundGradient};`),r+=(0,s.has)(n,"borderColor")&&!(0,s.isEmpty)(n.borderColor)?`border-color: ${n.borderColor};`:"",r+=(0,s.has)(n,"borderWidth")&&n.borderWidth>0?`border-width: ${n.borderWidth}px;`:"",r+=(0,s.has)(n,"borderWidth")&&n.borderWidth>0?"border-style: solid;":"",r+=(0,s.has)(n,"borderRadius")&&!(0,s.isEmpty)(n.borderRadius)?`border-radius: ${n.borderRadius};`:"",r&&(e+=`${a} { ${r} }`);let i="";return i+=(0,s.has)(n,"hoverTextColor")&&!(0,s.isEmpty)(n.hoverTextColor)?`color: ${n.hoverTextColor};`:"",i+=(0,s.has)(n,"hoverBackgroundColor")&&!(0,s.isEmpty)(n.hoverBackgroundColor)?`background: ${n.hoverBackgroundColor};`:"",(0,s.has)(n,"hoverBackgroundGradient")&&!(0,s.isEmpty)(n.hoverBackgroundGradient)&&(i+=`background: ${n.hoverBackgroundGradient};`),i+=(0,s.has)(n,"hoverBorderColor")&&!(0,s.isEmpty)(n.hoverBorderColor)?`border-color: ${n.hoverBorderColor};`:"",i&&(e+=`${a}:hover { ${i} }`),(0,g.applyFilters)(`gutenify--${K}--inline-styles`,e,t)}));const{attributes:X,name:Y,supports:ee}=h,te={title:(0,n.__)("Gallery Carousel"),description:(0,n.__)("Gutenify Gallery Carousel."),icon:(0,l.createElement)(r.Icon,{icon:J}),keywords:["gutenify",(0,n.__)("Gallery Carousel"),(0,n.__)("Gallery"),(0,n.__)("Carousel"),(0,n.__)("Slider"),(0,n.__)("Sliders")],example:{attributes:{}},attributes:X,edit:q,save:()=>{},supports:ee};(0,i.registerBlockType)(Y,{...te})},4184:(e,t)=>{var a;!function(){"use strict";var l={}.hasOwnProperty;function n(){for(var e=[],t=0;t<arguments.length;t++){var a=arguments[t];if(a){var r=typeof a;if("string"===r||"number"===r)e.push(a);else if(Array.isArray(a)){if(a.length){var i=n.apply(null,a);i&&e.push(i)}}else if("object"===r)if(a.toString===Object.prototype.toString)for(var o in a)l.call(a,o)&&a[o]&&e.push(o);else e.push(a.toString())}}return e.join(" ")}e.exports?(n.default=n,e.exports=n):void 0===(a=function(){return n}.apply(t,[]))||(e.exports=a)}()}},a={};function l(e){var n=a[e];if(void 0!==n)return n.exports;var r=a[e]={exports:{}};return t[e](r,r.exports,l),r.exports}l.m=t,e=[],l.O=(t,a,n,r)=>{if(!a){var i=1/0;for(d=0;d<e.length;d++){for(var[a,n,r]=e[d],o=!0,c=0;c<a.length;c++)(!1&r||i>=r)&&Object.keys(l.O).every((e=>l.O[e](a[c])))?a.splice(c--,1):(o=!1,r<i&&(i=r));if(o){e.splice(d--,1);var s=n();void 0!==s&&(t=s)}}return t}r=r||0;for(var d=e.length;d>0&&e[d-1][2]>r;d--)e[d]=e[d-1];e[d]=[a,n,r]},l.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return l.d(t,{a:t}),t},l.d=(e,t)=>{for(var a in t)l.o(t,a)&&!l.o(e,a)&&Object.defineProperty(e,a,{enumerable:!0,get:t[a]})},l.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={8490:0,4413:0};l.O.j=t=>0===e[t];var t=(t,a)=>{var n,r,[i,o,c]=a,s=0;if(i.some((t=>0!==e[t]))){for(n in o)l.o(o,n)&&(l.m[n]=o[n]);if(c)var d=c(l)}for(t&&t(a);s<i.length;s++)r=i[s],l.o(e,r)&&e[r]&&e[r][0](),e[r]=0;return l.O(d)},a=globalThis.webpackChunkgutenify=globalThis.webpackChunkgutenify||[];a.forEach(t.bind(null,0)),a.push=t.bind(null,a.push.bind(a))})();var n=l.O(void 0,[4413],(()=>l(5622)));n=l.O(n)})();