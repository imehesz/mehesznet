<?php include_once 'header.tpl.php'; ?>
<body onclick="console.log('Hello', event.target);">
	<div class="toolbar">
		<h1 id="pageTitle"></h1>
		<a id="backButton" class="button" href="#"></a>
        	<?php /* <a class="button" href="#searchForm">Search</a> */ ?>
	</div>

	<ul id="isearch" title="iSearch" selected="true">
	<li><a href="index.php?/country/list">list</a></li>
	<li><a href="/country/search">search</a></li>
	<li><div style="width:100%;color:#999;font-size:10px;text-align:center;">mehesz<span style="color:#f00;">.</span>net</div></li>
	</ul>
</body>
