(()=>{"use strict";const t=window.wp.hooks,e=window.lodash,i=window.wp.i18n;var s;const o=null!==(s=window)&&void 0!==s&&s._gutenify_vars?window._gutenify_vars:{},{is_pro_activated:r,pro_account_url:a,pro_license_status:l,title:n,prefix:u,slug:c,authorWebSite:_,authorDemoWebSite:d,authorWebSiteProPage:b,defaultTheme:p,authorWebSiteSupport:g,plugin_directory_url:w,brand_color:f,plugin_main_version:m,documentationsURL:h,pro_title:v,active_blocks:k,plugin_main_camel_case_name:y}=o;null!=o&&o.siteUrl?o.siteUrl:o.site_url,(0,i.sprintf)("Want to enjoy all feature of blocks? Checkout %1$s%2$s%3$s.",'<a href="'+b+'" target="_blank">',v,"</a>"),(0,t.addFilter)("blocks.registerBlockType",`${c}--add-attributes`,(function(t){var i,s;const{name:o}=t,r=o.split("/");return!r||r.lenght<2||(r[0].trim(),null!=t&&null!==(i=t.attributes)&&void 0!==i&&i.blockClientId||(t.attributes=(0,e.assign)(t.attributes,{blockClientId:{type:"string",default:""}})),null!=t&&null!==(s=t.attributes)&&void 0!==s&&s.customCss||(t.attributes=(0,e.assign)(t.attributes,{customCss:{type:"string",default:""}}))),t}))})();