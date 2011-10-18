/*=======Ver: 6.1.50831========*/
function stfltshB(p){if(!STM_FILTER) return 1;if(!p.eff[0]) return 1;var l=p._shell,fl=l.filters;stfltsp(p);fl[0].apply();return 1;}
function stfltshE(p){if(!STM_FILTER) return 1;if(!p.eff[0]) return 1;var l=p._shell;l.filters[0].play();return 1;}
function stflthdB(p){if(!STM_FILTER) return 1;if(!p.eff[1]) return 1;var l=p._shell,fl=l.filters;stfltsp(p);l.filters[p.eff[0]?1:0].apply();return 1;}
function stflthdE(p){if(!STM_FILTER) return 1;if(!p.eff[1]) return 1;var l=p._shell;l.filters[p.eff[0]?1:0].play();return 1;}
function stfltsp(p){var l=p._shell,fl=l.filters,n=0;if(p.eff[0]) n++;if(p.eff[1]) n++;for(var j=0;j<n;j++)if(fl[j].status) fl[j].stop();}
