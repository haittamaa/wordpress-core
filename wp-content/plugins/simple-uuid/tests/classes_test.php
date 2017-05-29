<?php

/**
* To execute these tests, navigate to http://<server>/wordpress/wp-content/plugins/xml-export/tests/classes_test.php
*/

require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');
require_once("../../../../wp-config.php");
require_once("../simple-uuid.php");

class TestOfSimpleUuid extends UnitTestCase
{
    function TestOfSimpleUuid()
	{
        $this->UnitTestCase('SimpleUuid class');
    }
	
    function test_new_uuid()
	{
        $uuid = new_uuid();
        $this->assertNotNull($uuid);
        $fields = split('-', $uuid);
        $this->assertEqual(sizeof($fields), 5);
        $this->assertEqual(strlen($fields[0]), 8);
        $this->assertEqual(strlen($fields[1]), 4);
        $this->assertEqual(strlen($fields[2]), 4);
        $this->assertEqual(strlen($fields[3]), 4);
        $this->assertEqual(strlen($fields[4]), 12);
    }

    function test_prefixing()
    {
        $uuid = new_uuid('prefix-');
        $fields = split('-', $uuid);
        $this->assertEqual($fields[0], 'prefix');
    }
}

$test = &new TestOfSimpleUuid();
$test->run(new HtmlReporter());
?>
