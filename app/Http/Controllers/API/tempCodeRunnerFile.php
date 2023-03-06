<?php
return Book::with('user')->findOrfail($id);