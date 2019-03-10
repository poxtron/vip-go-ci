<?php

require_once( __DIR__ . '/IncludesForTests.php' );

use PHPUnit\Framework\TestCase;

final class GitHubPrGenericCommentsGetTest extends TestCase {
	var $options_git_repo_tests = array(
		'pr-test-github-pr-reviews-get-1'	=> null
	);

	var $options_git = array(
		'repo-owner'				=> null,
		'repo-name'				=> null,
		'github-token'				=> null,
	);

	protected function setUp() {
		vipgoci_unittests_get_config_values(
			'git',
			$this->options_git
		);

		vipgoci_unittests_get_config_values(
			'git-repo-tests',
			$this->options_git_repo_tests
		);

		$this->options = array_merge(
			$this->options_git,
			$this->options_git_repo_tests
		);

		$this->options['token'] =
		$this->options['github-token'];
	}

	protected function tearDown() {
		$this->options_git_repo_tests = null;
		$this->options_git = null;
		$this->options = null;
	}

	/**
	 * @covers ::vipgoci_github_pr_generic_comments_get
	 */
	public function testGitHubPrGenericCommentsGet1() {
		$pr_comments = array();

		ob_start();

		$pr_comments = vipgoci_github_pr_generic_comments_get(
			$this->options['repo-owner'],
			$this->options['repo-name'],
			$this->options['pr-test-github-pr-reviews-get-1'],
			$this->options['github-token']
		);

		ob_end_clean();

		$this->assertEquals(
			1,
			count( array_keys( $pr_comments ) )
		);

		$this->assertEquals(
			471306810,
			$pr_comments[0]->id
		);

		$this->assertEquals(
			'Testing of generic comments.',
			$pr_comments[0]->body
		);
	}
}
