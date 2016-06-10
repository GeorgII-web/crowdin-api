<?php
/**
 * Crowdin API implementation in PHP.
 *
 * @copyright  Copyright (C) 2016 Nikolai Plath (elkuku)
 * @license    GNU General Public License version 2 or later
 */
namespace Tests;

use ElKuKu\Crowdin\Package\Glossary;

use Tests\Fake\FakeClient;

/**
 * Class GlossaryTest
 *
 * @since  1.0.7
 */
class GlossaryTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Glossary
	 */
	protected $object;

	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 *
	 * @return void
	 */
	protected function setUp()
	{
		$this->object = new Glossary('{projectID}', '{APIKey}', new FakeClient);
	}

	/**
	 * Test method.
	 *
	 * @covers ElKuKu\Crowdin\Package\Glossary::download
	 *
	 * @return void
	 */
	public function testDownload()
	{
		$this->assertThat(
			$this->object->download(),
			$this->equalTo('project/{projectID}/download-glossary?key={APIKey}&include_assigned=1')
		);
	}

	/**
	 * Test method.
	 *
	 * @covers ElKuKu\Crowdin\Package\Glossary::upload
	 * @expectedException  \UnexpectedValueException
	 *
	 * @return void
	 */
	public function testUploadException()
	{
		$this->object->upload('/file/not/found');
	}

	/**
	 * Test method.
	 *
	 * @covers ElKuKu\Crowdin\Package\Glossary::upload
	 *
	 * @return void
	 */
	public function testUpload()
	{
		// Remove the following lines when you implement this test.
		$this->markTestIncomplete(
			'This test has not been implemented yet (since it does a REAL request...)'
		);

		return;

		$this->assertThat(
			$this->object->upload(__DIR__ . '/Data/test.txt'),
			$this->equalTo('')
		);
	}
}
