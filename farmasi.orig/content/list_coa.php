<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Daftar Rekening</title>
<link rel="stylesheet" type="text/css" href="../include/SpryAccordion.css" />
<script type="text/javascript" src="../include/SpryEffects.js"></script>
<script type="text/javascript" src="../include/SpryAccordion.js"></script>

</head>
<body>
<div id='coaList' class='Accordion' tabindex='0'>
    <div class='AccordionPanel'>
        <div class='AccordionPanelTab'>Aktiva</div>
        <div class='AccordionPanelContent'>
        </div>
    </div>
    <div class='AccordionPanel'>
        <div class='AccordionPanelTab'>Passiva</div>
        <div class='AccordionPanelContent'>Panel 2 Content</div>
    </div>
    <div class='AccordionPanel'>
        <div class='AccordionPanelTab'>Modal</div>
        <div class='AccordionPanelContent'>Panel 3 Content</div>
    </div>
    <div class='AccordionPanel'>
        <div class='AccordionPanelTab'>Pendapatan</div>
        <div class='AccordionPanelContent'>Panel 4 Content</div>
    </div>
    <div class='AccordionPanel'>
        <div class='AccordionPanelTab'>Beban</div>
        <div class='AccordionPanelContent'>Panel 5 Content</div>
    </div>    
</div>
<script type="text/javascript"> var coaList = new Spry.Widget.Accordion("coaList", {defaultPanel: -1, useFixedPanelHeights: false}); </script>
</body>
</html>