{"version":3,"sources":["bitrix24.js"],"names":["iframeMode","window","top","search","location","sliderMode","indexOf","href","BX","addCustomEvent","response","encodeURIComponent","B24","getBackUrl","status","redirectUrl","uniquePopupId","bindElement","params","lightShadow","className","offsetTop","offsetLeft","angle","offset","config","JCClock","setOptions","centerXInline","centerX","centerYInline","centerY","minuteLength","hourLength","popupHeight","inaccuracy","cancelCheckClick","command","message","counters","clone","updateCounters","iDecrement","counterWrap","parseInt","oldVal","innerHTML","newVal","removeClass","parentNode","counter","updateInformer","im-message","ready","style","visibility","delegate","error","code","connectionStatus","this","sendErrorCode","browser","SupportLocalStorage","key","substring","value","getClass","placementInterface","rest","AppLayout","initializePlacement","prototype","showHelper","cb","query","type","isNumber","isNotEmptyString","isPlainObject","param","length","Helper","show","bind","throttle","onScroll","b24ConnectionStatusState","b24ConnectionStatus","b24ConnectionStatusText","b24ConnectionStatusTimeout","formateDate","time","util","str_pad","getHours","getMinutes","openLanguagePopup","button","isDomNode","PopupWindowManager","create","content","closeIcon","autoHide","closeByEsc","changeLanguage","lang","backUrl","pathname","getQueryString","ignoredParams","vars","split","isArray","result","i","pair","equal","in_array","informer","addClass","send","Bitrix24","LeftMenuClass","showNotifyPopup","hasClass","BXIM","closeNotify","openNotify","showMessagePopup","toggleMessenger","closeBanner","bannerId","userOptions","save","banner","minHeight","overflow","border","easing","duration","start","height","offsetHeight","opacity","finish","transition","makeEaseOut","transitions","quart","step","state","marginBottom","complete","display","animate","showLoading","timeout","loader","setTimeout","isReady","windowScroll","GetWindowScrollPos","getAttribute","scrollTop","setAttribute","goUp","fn","scroll","scrollTo","onCustomEvent","isFunction","toggleMenu","menuItem","messageShow","messageHide","menuBlock","findChild","tagName","menuItems","findChildren","toggleText","nextSibling","animation","scrollHeight","id","opening","maxHeight","linear","cssText","licenseInfoPopup","popupId","title","showDemoButton","LicenseInfoPopup","showPartnerForm","arParams","Bitrix24PartnerForm","bInit","popup","zIndex","overlay","draggable","restrict","titleBar","right","buttons","PopupWindowButtonLink","text","events","click","popupWindow","close","onAfterPopupShow","setContent","ajax","post","site_id","Timemanager","inited","layout","block","timer","info","event","tasks","data","clock","formatTime","ts","bSec","formatWorkTime","h","m","s","formatCurrentTime","hours","minutes","seconds","mt","isAmPmMode","init","reportJson","proxy","onDataRecieved","onPlannerDataRecieved","onPlannerQueryResult","onTaskTimerChange","registerFormat","statusBlock","taskTime","taskTimer","BXTIMEMAN","ShowFormWeekly","onTimemanClick","setBindOptions","node","mode","popupOptions","position","onPopupClose","redraw","Open","action","taskTimerSwitch","TIMER","RUN_TIME","TASK","TIME_SPENT_IN_LOGS","TIME_ESTIMATE","setTimer","setFrom","Date","INFO","DATE_START","dt","TIME_LEAKS","from","stopTimer","stop","redraw_planner","TASKS_ENABLED","TASKS_COUNT","CALENDAR_ENABLED","EVENT_TIME","PLANNER","STATE","CAN_OPEN","getStatusName","container","statusClass","startAnimation","endAnimation","OPEN_NOW","ob","animationTimeout","blinkAnimation","blinkLimit","blinkTimeout","startBlink","setInterval","endBlink","clearInterval","toggle","Bitrix24InviteDialog","Init","contentColor","contentNoPaddings","loadForm","InviteDialog","onInviteDialogClose","ShowForm","WindowManager","GetZIndex","adjustPosition","ReInvite","reinvite_user_id","reinvite","sessid","bitrix_sessid","b24ConnectionStatusStateText","clearTimeout","connectionPopup","document","querySelector","isFloat","attrs","data-role","data-float","children","props","html","IsMac","reload","nextNode","body","insertBefore","showPartnerOrderForm","Math","min","documentElement","clientHeight","width","sec","onPopupFirstShow","w","d","u","createElement","async","src","now","getElementsByTagName","upgradeButtonRedirect","url","COUNTER_URL","licensePath","LICENSE_PATH","host","HOST"],"mappings":"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","file":"bitrix24.map.js"}