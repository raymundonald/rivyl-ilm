"use strict";(globalThis.webpackChunkcomplianz_gdpr=globalThis.webpackChunkcomplianz_gdpr||[]).push([[6729,9091,7102,9758,5228,2010],{99091:(e,t,a)=>{a.r(t),a.d(t,{UseCookieScanData:()=>r});var n=a(81621),l=a(9588);const r=(0,n.vt)(((e,t)=>({initialLoadCompleted:!1,setInitialLoadCompleted:t=>e({initialLoadCompleted:t}),iframeLoaded:!1,loading:!1,nextPage:!1,progress:0,cookies:[],lastLoadedIframe:"",setIframeLoaded:t=>e({iframeLoaded:t}),setLastLoadedIframe:t=>e((e=>({lastLoadedIframe:t}))),setProgress:t=>e({progress:t}),fetchProgress:()=>(e({loading:!0}),l.doAction("get_scan_progress",{}).then((t=>(e({initialLoadCompleted:!0,loading:!1,nextPage:t.next_page,progress:t.progress,cookies:t.cookies}),t))))})))},7102:(e,t,a)=>{a.r(t),a.d(t,{default:()=>u});var n=a(86087),l=a(45111),r=a(27723),o=a(52010),c=a(15139),i=a(4219),s=a(81366),d=a(25228);const m=e=>{const{getFieldValue:t,showSavedSettingsNotice:a}=(0,i.default)(),{language:l,saving:o,purposesOptions:m,services:u,updateCookie:p,toggleDeleteCookie:_,saveCookie:g}=(0,c.default)(),[f,v]=(0,n.useState)(""),[b,E]=(0,n.useState)(""),[h,y]=(0,n.useState)(""),[k,z]=(0,n.useState)([]);let N="no"!==t("use_cdb_api"),w=!!N&&1==e.sync,C=w;o&&(C=!0);let S=!1;e.slug.length>0&&(S="https://cookiedatabase.org/cookie/"+(e.service?e.service:"unknown-service")+"/"+e.slug),(0,n.useEffect)((()=>{e&&e.cookieFunction&&y(e.cookieFunction)}),[e]);const I=(e,t,a)=>{p(t,a,e)};(0,n.useEffect)((()=>{e&&e.name&&v(e.name)}),[e.name]),(0,n.useEffect)((()=>{if(!e)return;if(e.name===f)return;const t=setTimeout((()=>{p(e.ID,"name",f)}),500);return()=>{clearTimeout(t)}}),[f]),(0,n.useEffect)((()=>{if(!e)return;if(e.cookieFunction===h)return;const t=setTimeout((()=>{p(e.ID,"cookieFunction",h)}),500);return()=>{clearTimeout(t)}}),[h]),(0,n.useEffect)((()=>{e&&e.retention&&E(e.retention)}),[e.retention]),(0,n.useEffect)((()=>{if(!e)return;if(e.retention===b)return;const t=setTimeout((()=>{p(e.ID,"retention",b)}),500);return()=>{clearTimeout(t)}}),[b]),(0,n.useEffect)((()=>{let e=m&&m.hasOwnProperty(l)?m[l]:[];e=e.map((e=>({label:e.label,value:e.label}))),z(e)}),[l,m]);const D=(e,t,a)=>{p(t,a,e)};if(!e)return null;let O=-1!==e.name.indexOf("cmplz_")||w,T=1!=e.deleted?"cmplz-reset-button":"",x=u.map(((e,t)=>({value:e.ID,label:e.name}))),A=!1,L="Marketing";k.forEach((function(e,t){e.value&&-1!==e.value.indexOf("/")&&(A=!0,L=e.value,L=L.substring(0,L.indexOf("/")))}));let P=e.purpose&&-1!==e.purpose.indexOf("/");P&&(L=e.purpose.substring(0,e.purpose.indexOf("/"))),A&&!P&&k.forEach((function(e,t){e.value&&-1!==e.value.indexOf("/")&&(e.value=L,e.label=L,k[t]=e)}));let U=e.purpose;return!A&&P&&(U=L),(0,n.createElement)(n.Fragment,null,(0,n.createElement)("div",{className:"cmplz-details-row cmplz-details-row__checkbox"},(0,n.createElement)(s.default,{id:e.ID+"_cdb_api",disabled:!N,value:w,onChange:t=>D(t,e.ID,"sync"),options:{true:(0,r.__)("Sync cookie with cookiedatabase.org","complianz-gdpr")}})),(0,n.createElement)("div",{className:"cmplz-details-row cmplz-details-row__checkbox"},(0,n.createElement)(s.default,{id:e.ID+"showOnPolicy",disabled:C,value:e.showOnPolicy,onChange:t=>D(t,e.ID,"showOnPolicy"),options:{true:(0,r.__)("Show cookie on Cookie Policy","complianz-gdpr")}})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,r.__)("Name","complianz-gdpr")),(0,n.createElement)("input",{disabled:C,onChange:e=>v(e.target.value),type:"text",placeholder:(0,r.__)("Name","complianz-gdpr"),value:f})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,r.__)("Service","complianz-gdpr")),(0,n.createElement)(d.default,{disabled:C,value:e.serviceID,options:x,onChange:t=>I(t,e.ID,"serviceID")})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,r.__)("Expiration","complianz-gdpr")),(0,n.createElement)("input",{disabled:O,onChange:e=>E(e.target.value),type:"text",placeholder:(0,r.__)("1 year","complianz-gdpr"),value:b})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,r.__)("Cookie function","complianz-gdpr")),(0,n.createElement)("input",{disabled:C,onChange:e=>y(e.target.value),type:"text",placeholder:(0,r.__)("e.g. store user ID","complianz-gdpr"),value:h})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,r.__)("Purpose","complianz-gdpr")),(0,n.createElement)(d.default,{disabled:C,value:U,options:k,onChange:t=>I(t,e.ID,"purpose")})),S&&(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("a",{href:S,target:"_blank",rel:"noopener noreferrer"},(0,r.__)("View cookie on cookiedatabase.org","complianz-gdpr"))),(0,n.createElement)("div",{className:"cmplz-details-row cmplz-details-row__buttons"},(0,n.createElement)("button",{disabled:o,onClick:t=>(async e=>{await g(e),a((0,r.__)("Saved cookie","complianz-gdpr"))})(e.ID),className:"button button-default"},(0,r.__)("Save","complianz-gdpr")),(0,n.createElement)("button",{className:"button button-default "+T,onClick:t=>(async e=>{await _(e)})(e.ID)},1==e.deleted&&(0,r.__)("Restore","complianz-gdpr"),1!=e.deleted&&(0,r.__)("Delete","complianz-gdpr"))))},u=(0,n.memo)((({cookie:e,id:t})=>{let a="";e.deleted?a=" | "+(0,r.__)("Deleted","complianz-gdpr"):e.showOnPolicy?e.isMembersOnly&&(a=" | "+(0,r.__)("Logged in users only, ignored","complianz-gdpr")):a=" | "+(0,r.__)("Admin, ignored","complianz-gdpr");let c=e.name;return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(o.default,{id:t,summary:c,comment:a,icons:(0,n.createElement)(n.Fragment,null,e.complete&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("The data for this cookie is complete","complianz-gdpr"),name:"success",color:"green"}),!e.complete&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("This cookie has missing fields","complianz-gdpr"),name:"times",color:"red"}),e.sync&&e.synced&&(0,n.createElement)(l.default,{name:"rotate",color:"green"}),!e.synced||!e.sync&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("This cookie is not synchronized with cookiedatabase.org.","complianz-gdpr"),name:"rotate-error",color:"red"}),e.showOnPolicy&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("This cookie will be on your Cookie Policy","complianz-gdpr"),name:"file",color:"green"}),!e.showOnPolicy&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("This cookie is not shown on the Cookie Policy","complianz-gdpr"),name:"file-disabled",color:"grey"}),e.old&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("This cookie has not been detected on your site in the last three months","complianz-gdpr"),name:"calendar-error",color:"red"}),!e.old&&(0,n.createElement)(l.default,{tooltip:(0,r.__)("This cookie has recently been detected","complianz-gdpr"),name:"calendar",color:"green"})),details:m(e),style:(()=>{if(e.deleted)return Object.assign({},{backgroundColor:"var(--rsp-red-faded)"})})()}))}))},36729:(e,t,a)=>{a.r(t),a.d(t,{default:()=>p});var n=a(86087),l=a(7102),r=a(52010),o=a(15139),c=a(27723),i=a(45111),s=a(4219),d=a(81366),m=a(25228);const u=e=>{const{getFieldValue:t,showSavedSettingsNotice:a}=(0,s.default)(),[l,r]=(0,n.useState)(""),[i,u]=(0,n.useState)(""),{language:p,saving:_,deleteService:g,serviceTypeOptions:f,updateService:v,saveService:b}=(0,o.default)();let E="yes"===t("use_cdb_api");const[h,y]=(0,n.useState)([]);(0,n.useEffect)((()=>{let e=f&&f.hasOwnProperty(p)?f[p]:[];e=e.map((e=>({label:e.label,value:e.label}))),y(e)}),[p,f]);const k=(e,t,a)=>{v(t,a,e)},z=(e,t,a)=>{v(t,a,e)};if((0,n.useEffect)((()=>{e&&e.name&&r(e.name)}),[e]),(0,n.useEffect)((()=>{if(!e)return;if(e.name===l)return;if(l.length<2)return;const t=setTimeout((()=>{k(l,e.ID,"name")}),500);return()=>{clearTimeout(t)}}),[l]),(0,n.useEffect)((()=>{e&&e.privacyStatementURL&&u(e.privacyStatementURL)}),[e]),(0,n.useEffect)((()=>{if(!e)return;if(e.privacyStatementURL===i)return;if(0===i.length)return;const t=setTimeout((()=>{k(i,e.ID,"privacyStatementURL")}),400);return()=>{clearTimeout(t)}}),[i]),!e)return null;let N=!!E&&1==e.sync,w=N;_&&(w=!0);let C=!1;return e.slug.length>0&&(C="https://cookiedatabase.org/service/"+e.slug),(0,n.createElement)(n.Fragment,null,(0,n.createElement)("div",{className:"cmplz-details-row cmplz-details-row__checkbox"},(0,n.createElement)(d.default,{id:e.ID+"sharesData",disabled:w,value:1==e.sharesData,onChange:t=>z(t,e.ID,"sharesData"),options:{true:(0,c.__)("Data is shared with this service","complianz-gdpr")}})),(0,n.createElement)("div",{className:"cmplz-details-row cmplz-details-row__checkbox"},(0,n.createElement)(d.default,{id:e.ID+"sync",disabled:!E,value:N,onChange:t=>z(t,e.ID,"sync"),options:{true:(0,c.__)("Sync service with cookiedatabase.org","complianz-gdpr")}})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,c.__)("Name","complianz-gdpr")),(0,n.createElement)("input",{disabled:w,onChange:e=>r(e.target.value),type:"text",placeholder:(0,c.__)("Name","complianz-gdpr"),value:l})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,c.__)("Service Types","complianz-gdpr")),(0,n.createElement)(m.default,{disabled:w,value:e.serviceType,options:h,onChange:t=>k(t,e.ID,"serviceType")})),(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("label",null,(0,c.__)("Privacy Statement URL","complianz-gdpr")),(0,n.createElement)("input",{disabled:w,onChange:e=>u(e.target.value),type:"text",value:i})),C&&(0,n.createElement)("div",{className:"cmplz-details-row"},(0,n.createElement)("a",{href:C,target:"_blank",rel:"noopener noreferrer"},(0,c.__)("View service on cookiedatabase.org","complianz-gdpr"))),(0,n.createElement)("div",{className:"cmplz-details-row cmplz-details-row__buttons"},(0,n.createElement)("button",{disabled:_,onClick:t=>(async e=>{await b(e),a((0,c.__)("Saved service","complianz-gdpr"))})(e.ID),className:"button button-default"},(0,c.__)("Save","complianz-gdpr")),(0,n.createElement)("button",{className:"button button-default cmplz-reset-button",onClick:t=>(async e=>{await g(e)})(e.ID)},(0,c.__)("Delete Service","complianz-gdpr"))))},p=(0,n.memo)((e=>{const{adding:t}=(0,o.default)(),a=e.service&&e.service.ID>0&&e.service.hasOwnProperty("name"),s=!e.service||e.service.ID<=0,d=e.service&&e.service.name?e.service.name:(0,c.__)("New Service","complianz-gdpr");return(0,n.createElement)(n.Fragment,null,(0,n.createElement)(r.default,{id:e.id,summary:e.name,icons:e.service?(0,n.createElement)(n.Fragment,null,e.service.complete&&(0,n.createElement)(i.default,{tooltip:(0,c.__)("The data for this service is complete","complianz-gdpr"),name:"success",color:"green"}),!e.service.complete&&(0,n.createElement)(i.default,{tooltip:(0,c.__)("This service has missing fields","complianz-gdpr"),name:"times",color:"red"}),e.service.synced&&(0,n.createElement)(i.default,{tooltip:(0,c.__)("This service has been synchronized with cookiedatabase.org","complianz-gdpr"),name:"rotate",color:"green"}),!e.service.synced&&(0,n.createElement)(i.default,{tooltip:(0,c.__)("This service is not synchronized with cookiedatabase.org","complianz-gdpr"),name:"rotate-error",color:"red"})):(0,n.createElement)(n.Fragment,null),details:(0,n.createElement)(n.Fragment,null,(0,n.createElement)("div",null,u(e.service)),e.cookies&&e.cookies.length>0&&(0,n.createElement)("div",{className:"cmplz-panel__cookie_list"},e.cookies.map(((e,t)=>(0,n.createElement)(l.default,{key:t,cookie:e})))),!s&&(0,n.createElement)("div",null,(0,n.createElement)("button",{disabled:t||!a,onClick:t=>((t,a)=>{e.addCookie(t,a)})(e.service.ID,d),className:"button button-default"},(0,c.__)("Add cookie to %s","complianz-gdpr").replace("%s",d),t&&(0,n.createElement)(i.default,{name:"loading",color:"grey"})),!a&&(0,n.createElement)("div",{className:"cmplz-comment"},(0,c.__)("Save service to be able to add cookies","complianz-gdpr"))))}))}))},79758:(e,t,a)=>{a.r(t),a.d(t,{default:()=>d});var n=a(86087),l=a(9588),r=a(4219),o=a(52043),c=a(56427),i=a(99091),s=a(32828);const d=(0,n.memo)((({type:e="action",style:t="tertiary",label:a,onClick:d,href:m="",target:u="",disabled:p,action:_,field:g,children:f})=>{if(!a&&!f)return null;const v=(g&&g.button_text?g.button_text:a)||f,{fetchFieldsData:b,showSavedSettingsNotice:E}=(0,r.default)(),{setInitialLoadCompleted:h,setProgress:y}=(0,i.UseCookieScanData)(),{setProgressLoaded:k}=(0,s.default)(),{selectedSubMenuItem:z}=(0,o.default)(),[N,w]=(0,n.useState)(!1),C=`button cmplz-button button--${t} button-${e}`,S=async e=>{await l.doAction(g.action,{}).then((e=>{e.success&&(b(z),"reset_settings"===e.id&&(h(!1),y(0),k(!1)),E(e.message))}))},I=g&&g.warn?g.warn:"";return"action"===e?(0,n.createElement)(n.Fragment,null,c.__experimentalConfirmDialog&&(0,n.createElement)(c.__experimentalConfirmDialog,{isOpen:N,onConfirm:async()=>{w(!1),await S()},onCancel:()=>{w(!1)}},I),(0,n.createElement)("button",{className:C,onClick:async t=>{if("action"!==e||!d)return"action"===e&&_?c.__experimentalConfirmDialog?void(g&&g.warn?w(!0):await S()):void await S():void(window.location.href=g.url);d(t)},disabled:p},v)):"link"===e?(0,n.createElement)("a",{className:C,href:m,target:u},v):void 0}))},81366:(e,t,a)=>{a.r(t),a.d(t,{default:()=>I});var n=a(86087),l=a(58168),r=a(51609),o=a(91071),c=a(62133),i=a(9957),s=a(81351),d=a(85357),m=a(31769),u=a(7971),p=a(12579);const _="Checkbox",[g,f]=(0,c.A)(_),[v,b]=g(_),E=(0,r.forwardRef)(((e,t)=>{const{__scopeCheckbox:a,name:n,checked:c,defaultChecked:d,required:m,disabled:u,value:_="on",onCheckedChange:g,...f}=e,[b,E]=(0,r.useState)(null),z=(0,o.s)(t,(e=>E(e))),N=(0,r.useRef)(!1),w=!b||Boolean(b.closest("form")),[C=!1,S]=(0,s.i)({prop:c,defaultProp:d,onChange:g}),I=(0,r.useRef)(C);return(0,r.useEffect)((()=>{const e=null==b?void 0:b.form;if(e){const t=()=>S(I.current);return e.addEventListener("reset",t),()=>e.removeEventListener("reset",t)}}),[b,S]),(0,r.createElement)(v,{scope:a,state:C,disabled:u},(0,r.createElement)(p.sG.button,(0,l.A)({type:"button",role:"checkbox","aria-checked":y(C)?"mixed":C,"aria-required":m,"data-state":k(C),"data-disabled":u?"":void 0,disabled:u,value:_},f,{ref:z,onKeyDown:(0,i.m)(e.onKeyDown,(e=>{"Enter"===e.key&&e.preventDefault()})),onClick:(0,i.m)(e.onClick,(e=>{S((e=>!!y(e)||!e)),w&&(N.current=e.isPropagationStopped(),N.current||e.stopPropagation())}))})),w&&(0,r.createElement)(h,{control:b,bubbles:!N.current,name:n,value:_,checked:C,required:m,disabled:u,style:{transform:"translateX(-100%)"}}))})),h=e=>{const{control:t,checked:a,bubbles:n=!0,...o}=e,c=(0,r.useRef)(null),i=(0,d.Z)(a),s=(0,m.X)(t);return(0,r.useEffect)((()=>{const e=c.current,t=window.HTMLInputElement.prototype,l=Object.getOwnPropertyDescriptor(t,"checked").set;if(i!==a&&l){const t=new Event("click",{bubbles:n});e.indeterminate=y(a),l.call(e,!y(a)&&a),e.dispatchEvent(t)}}),[i,a,n]),(0,r.createElement)("input",(0,l.A)({type:"checkbox","aria-hidden":!0,defaultChecked:!y(a)&&a},o,{tabIndex:-1,ref:c,style:{...e.style,...s,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function y(e){return"indeterminate"===e}function k(e){return y(e)?"indeterminate":e?"checked":"unchecked"}const z=E,N=(0,r.forwardRef)(((e,t)=>{const{__scopeCheckbox:a,forceMount:n,...o}=e,c=b("CheckboxIndicator",a);return(0,r.createElement)(u.C,{present:n||y(c.state)||!0===c.state},(0,r.createElement)(p.sG.span,(0,l.A)({"data-state":k(c.state),"data-disabled":c.disabled?"":void 0},o,{ref:t,style:{pointerEvents:"none",...e.style}})))}));var w=a(27723),C=a(45111),S=a(79758);const I=(0,n.memo)((({indeterminate:e,label:t,value:a,id:l,onChange:r,required:o,disabled:c,options:i={}})=>{const[s,d]=(0,n.useState)(!1),[m,u]=(0,n.useState)(!1);let p=a;Array.isArray(p)||(p=""===p?[]:[p]),(0,n.useEffect)((()=>{let e=1===Object.keys(i).length&&"true"===Object.keys(i)[0];d(e)}),[]),e&&(a=!0);const _=p;let g=!1;Object.keys(i).length>10&&(g=!0);const f=e=>s?a:_.includes(""+e)||_.includes(parseInt(e)),v=()=>{u(!m)};let b=c&&!Array.isArray(c);return 0===Object.keys(i).length?(0,n.createElement)(n.Fragment,null,(0,w.__)("No options found","complianz-gdpr")):(0,n.createElement)("div",{className:"cmplz-checkbox-group"},Object.entries(i).map((([i,d],u)=>(0,n.createElement)("div",{key:i,className:"cmplz-checkbox-group__item"+(!m&&u>9?" cmplz-hidden":"")},(0,n.createElement)(z,{className:"cmplz-checkbox-group__checkbox",id:l+"_"+i,checked:f(i),"aria-label":t,disabled:b||Array.isArray(c)&&c.includes(i),required:o,onCheckedChange:e=>((e,t)=>{if(s)r(!a);else{const e=_.includes(""+t)||_.includes(parseInt(t))?_.filter((e=>e!==""+t&&e!==parseInt(t))):[..._,t];r(e)}})(0,i)},(0,n.createElement)(N,{className:"cmplz-checkbox-group__indicator"},(0,n.createElement)(C.default,{name:e?"indeterminate":"check",size:14,color:"dark-blue"}))),(0,n.createElement)("label",{className:"cmplz-checkbox-group__label",htmlFor:l+"_"+i},d)))),!m&&g&&(0,n.createElement)(S.default,{onClick:()=>v()},(0,w.__)("Show more","complianz-gdpr")),m&&g&&(0,n.createElement)(S.default,{onClick:()=>v()},(0,w.__)("Show less","complianz-gdpr")))}))},25228:(e,t,a)=>{a.r(t),a.d(t,{default:()=>c});var n=a(86087),l=a(45296),r=a(45111),o=a(27723);const c=(0,n.memo)((({value:e=!1,onChange:t,required:a,defaultValue:c,disabled:i,options:s={},canBeEmpty:d=!0,label:m})=>{if(Array.isArray(s)){let e={};s.map((t=>{e[t.value]=t.label})),s=e}return d?(""===e||!1===e||0===e)&&(e="0",s={0:(0,o.__)("Select an option","complianz-gdpr"),...s}):e||(e=Object.keys(s)[0]),(0,n.createElement)("div",{className:"cmplz-input-group cmplz-select-group",key:m},(0,n.createElement)(l.bL,{value:e,defaultValue:c,onValueChange:t,required:a,disabled:i&&!Array.isArray(i)},(0,n.createElement)(l.l9,{className:"cmplz-select-group__trigger"},(0,n.createElement)(l.WT,null),(0,n.createElement)(r.default,{name:"chevron-down"})),(0,n.createElement)(l.UC,{className:"cmplz-select-group__content",position:"popper"},(0,n.createElement)(l.PP,{className:"cmplz-select-group__scroll-button"},(0,n.createElement)(r.default,{name:"chevron-up"})),(0,n.createElement)(l.LM,{className:"cmplz-select-group__viewport"},(0,n.createElement)(l.YJ,null,Object.entries(s).map((([e,t])=>(0,n.createElement)(l.q7,{disabled:Array.isArray(i)&&i.includes(e),className:"cmplz-select-group__item",key:e,value:e},(0,n.createElement)(l.p4,null,t)))))),(0,n.createElement)(l.wn,{className:"cmplz-select-group__scroll-button"},(0,n.createElement)(r.default,{name:"chevron-down"})))))}))},52010:(e,t,a)=>{a.r(t),a.d(t,{default:()=>r});var n=a(86087),l=a(45111);const r=e=>{const[t,a]=(0,n.useState)(!1);return(0,n.createElement)("div",{className:"cmplz-panel__list__item",style:e.style?e.style:{}},(0,n.createElement)("details",{open:t},(0,n.createElement)("summary",{onClick:e=>(e=>{e.preventDefault(),a(!t)})(e)},e.icon&&(0,n.createElement)(l.default,{name:e.icon}),(0,n.createElement)("h5",{className:"cmplz-panel__list__item__title"},e.summary),(0,n.createElement)("div",{className:"cmplz-panel__list__item__comment"},e.comment),(0,n.createElement)("div",{className:"cmplz-panel__list__item__icons"},e.icons),(0,n.createElement)(l.default,{name:"chevron-down",size:18})),(0,n.createElement)("div",{className:"cmplz-panel__list__item__details"},t&&e.details)))}},7971:(e,t,a)=>{a.d(t,{C:()=>c});var n=a(51609),l=a(75795),r=a(91071),o=a(88200);const c=e=>{const{present:t,children:a}=e,c=function(e){const[t,a]=(0,n.useState)(),r=(0,n.useRef)({}),c=(0,n.useRef)(e),s=(0,n.useRef)("none"),d=e?"mounted":"unmounted",[m,u]=function(e,t){return(0,n.useReducer)(((e,a)=>{const n=t[e][a];return null!=n?n:e}),e)}(d,{mounted:{UNMOUNT:"unmounted",ANIMATION_OUT:"unmountSuspended"},unmountSuspended:{MOUNT:"mounted",ANIMATION_END:"unmounted"},unmounted:{MOUNT:"mounted"}});return(0,n.useEffect)((()=>{const e=i(r.current);s.current="mounted"===m?e:"none"}),[m]),(0,o.N)((()=>{const t=r.current,a=c.current;if(a!==e){const n=s.current,l=i(t);e?u("MOUNT"):"none"===l||"none"===(null==t?void 0:t.display)?u("UNMOUNT"):u(a&&n!==l?"ANIMATION_OUT":"UNMOUNT"),c.current=e}}),[e,u]),(0,o.N)((()=>{if(t){const e=e=>{const a=i(r.current).includes(e.animationName);e.target===t&&a&&(0,l.flushSync)((()=>u("ANIMATION_END")))},a=e=>{e.target===t&&(s.current=i(r.current))};return t.addEventListener("animationstart",a),t.addEventListener("animationcancel",e),t.addEventListener("animationend",e),()=>{t.removeEventListener("animationstart",a),t.removeEventListener("animationcancel",e),t.removeEventListener("animationend",e)}}u("ANIMATION_END")}),[t,u]),{isPresent:["mounted","unmountSuspended"].includes(m),ref:(0,n.useCallback)((e=>{e&&(r.current=getComputedStyle(e)),a(e)}),[])}}(t),s="function"==typeof a?a({present:c.isPresent}):n.Children.only(a),d=(0,r.s)(c.ref,s.ref);return"function"==typeof a||c.isPresent?(0,n.cloneElement)(s,{ref:d}):null};function i(e){return(null==e?void 0:e.animationName)||"none"}c.displayName="Presence"}}]);