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
require_once ('db.php');

$db = loadDb();

$id = strval($_POST['id']);
$direction = strval($_POST['direction']);
$index = array_search($id, array_keys($db));

if (($direction === 'up' && $index == 0)
		|| ($direction === 'down' && $index == count($db) - 1)) {
	header('HTTP/1.1 405 Not allowed');
	exit;
}

if ($direction === 'up') {
	$head = $index - 2 >= 0 ? array_slice($db, 0, $index - 1, true) : array();
	$pair = array_reverse(array_slice($db, $index - 1, 2, true), true);
	$tail = $index + 1 < count($db) ? array_slice($db, $index + 1, count($db), true) : array();
} else {
	$head = $index > 0 ? array_slice($db, 0, $index, true) : array();
	$pair = array_reverse(array_slice($db, $index, 2, true), true);
	$tail = $index + 2 < count($db) ? array_slice($db, $index + 2, count($db), true) : array();
}

$db = array_merge($head, $pair, $tail);

saveDb($db);