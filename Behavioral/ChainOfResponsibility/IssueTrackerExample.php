<?php
	/*
	* Example for chain of responsibility pattern
	*/
	
	// Handler
	abstract class IssueTracker {
		
		protected $successor;
		
		public function setSuccessor($successor) {
			$this->successor = $successor;
		}
		abstract public function processIssue($issue);
	}
	
	// Concrete Handlers
	class CodeIssueHandler extends IssueTracker {
		
		public function processIssue($issue) {
			$type = $issue['type'];
			$name = $issue['name'];
			if($type ==  'code') {
				echo "<br/>Code issue: Code handler take: $name";
			} else if($this->successor != null) {
				echo "<br/>Escalating $name to next successor";
				$this->successor->processIssue($issue);
			}
		}
	}
	
	class DesignIssueHandler extends IssueTracker {
		
		public function processIssue($issue) {
			$type = $issue['type'];
			$name = $issue['name'];
			if($type ==  'design') {
				echo "<br/>Design issue: Design handler take:$name";
			} else if($this->successor != null) {
				echo "<br/>Escalating $name to next successor";
				$this->successor->processIssue($issue);
			}
		}
	}
	
	class ServerIssueHandler extends IssueTracker {
		
		public function processIssue($issue) {
			$type = $issue['type'];
			$name = $issue['name'];
			if($type ==  'server') {
				echo "<br/>Server issue: Server Admin take:$name";
			} else if($this->successor != null) {
				echo "<br/>Escalating $name to next successor";
				$this->successor->processIssue($issue);
			} else {
				
			}
		}
	}
	
	// usage
	$codeHandler = new CodeIssueHandler();
	$designHandler = new DesignIssueHandler();
	$serverHandler = new ServerIssueHandler();
	
	$codeHandler->setSuccessor($designHandler);
	$designHandler->setSuccessor($serverHandler);
	
	$issue1 = array('type' => 'design', 'name' => 'issue1');
	$issue2 = array('type' => 'server', 'name' => 'issue2');
	$issue3 = array('type' => 'code', 'name' => 'issue3');
	
	echo "<br/>Issue 1: Design";
	$codeHandler->processIssue($issue1);
	echo "<br/><br/>Issue 2: Server";
	$codeHandler->processIssue($issue2);
	echo "<br/><br/>Issue 3: Code";
	$codeHandler->processIssue($issue3);
	
?>
