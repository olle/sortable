<?php
/*
 * The MIT License
 * 
 * Copyright (c) 2008-2009 Olle Törnström studiomediatech.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author  Olle Törnström olle[at]studiomediatech[dot]com
 * @since   2009-09-24
 */
require_once 'php/db.php';
$items = loadDb(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>sortable</title>
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/jquery.sortable.css" />
    </head>
	<body>
		<div class="page">
			<h1>Sortable lists with jQuery!</h1>
			<p>
				This plugin provides Ajax sorting of <code>UL</code> and 
				<code>OL</code> HTML lists by adding sorting buttons to the list
				element.
			</p>
			<p>
				Try out the example below by hovering any row in the list.
			</p>
			<div class="example">
				<ul class="sortable">
					<?php foreach ($items as $id => $name): ?>
					<li id="<?php echo $id ?>"><?php echo $name ?></li>
					<?php endforeach ?>
				</ul>			
			</div>
			<p>
				You can get sorted yourself, the code is <b>free</b> and
				available on GitHub at 
				<a href="http://github.com/olle/sortable">http://github.com/olle/sortable</a>.				
			</p>
			<h2>How it works</h2>
			<p>
				The Sortable plugin degrades completely so we always assume the 
				list is built up as a valid list, ordered from the server.
			</p>
			<h3>1. Build lists with valid and unique <code>id</code>s.</h3>
			<pre>
&lt;ul class="sortable"&gt;
   &lt;?php foreach ($items as $id => $name): ?&gt;
   &lt;li id="<code>item-</code>&lt;?php echo $id ?&gt;"&gt;
      &lt;?php echo $name ?&gt;
   &lt;/li&gt;
   &lt;?php endforeach ?&gt;						
&lt;/ul&gt;
			</pre>
			<p>
				<em>The <code>item-</code> prefix will ensure valid (X)HTML.</em>
			</p>
			<h3>2. Attach the plugin with an Ajax handler for sorting.</h3>
			<p>
				Using a jQuery selector you attach the plugin to the list element
				and it inserts the sorting buttons bound to an Ajax handler.
			</p>
			<pre>
&lt;script type="text/javascript"&gt;
   $('ul.sortable').sortable({
      handler : 'php/jquery.sortable.php'
   });
&lt;/script&gt;
			</pre>
			<p>
				The handler will receive the posted parameters <code>id</code>, 
				with the element id, and <code>direction</code> with either the 
				value <code>up</code> or <code>down</code>.
			</p>
			<h3>3. Build an Ajax handler</h3>
			<p>
				The handler only needs to respond with a regular <code>HTTP/1.1 200 OK</code>,
				or in the case that sorting couldn't be done 
				<code>HTTP/1.1 405 Method Not Allowed</code>. Don't forget to
				do the actual sorting and storing of the results on the server.
			</p>
			<h2>Customization</h2>
			<p>
				Options to the Sorting plugin can be easily passed in the call. 
				The current options and their default values are:
				<pre>
<code>handler</code> : <em>'php/jquery.sortable.php'</em>
<code>upClass</code> : <em>'up'</em>
<code>downClass</code> : <em>'down'</em>
<code>sorterClass</code> : <em>'sorting'</em>
				</pre>
			</p>
			<div>
				<p>
				    <a href="http://validator.w3.org/check?uri=referer"><img
				        src="http://www.w3.org/Icons/valid-xhtml10-blue"
				        alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>
				</p>
			</div>
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.sortable.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('.sortable').sortable();
			});
		</script>
	</body>
</html>