<?php
/**
 *
 * Topic Prefixes extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016 phpBB Limited <https://www.phpbb.com>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace phpbb\topicprefixes\tests\system;

class simple_test extends \phpbb_test_case
{
	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject|\Symfony\Component\DependencyInjection\ContainerInterface
	 */
	protected $container;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\finder
	 */
	protected $extension_finder;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject|\phpbb\db\migrator
	 */
	protected $migrator;

	/**
	 * @inheritdoc
	 */
	public function setUp()
	{
		parent::setUp();

		// Stub the container
		$this->container = $this->getMock('\Symfony\Component\DependencyInjection\ContainerInterface');

		// Stub the ext finder and disable its constructor
		$this->extension_finder = $this->getMockBuilder('\phpbb\finder')
			->disableOriginalConstructor()
			->getMock();

		// Stub the migrator and disable its constructor
		$this->migrator = $this->getMockBuilder('\phpbb\db\migrator')
			->disableOriginalConstructor()
			->getMock();
	}

	/**
	 * Test the extension can only be enabled when the minimum
	 * phpBB version requirement is satisfied.
	 */
	public function test_ext()
	{
		$ext = new \phpbb\topicprefixes\ext($this->container, $this->extension_finder, $this->migrator, 'phpbb/topicprefixes', '');

		$this->assertTrue($ext->is_enableable(), 'Asserting that the extension is enableable.');
	}
}
