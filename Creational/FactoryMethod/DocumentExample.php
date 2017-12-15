<?php
/// The 'Product' abstract class
abstract class Page {
}

//A 'ConcreteProduct' class
class SkillsPage extends Page {
}
//A 'ConcreteProduct' class
class EducationPage extends Page {
}

//A 'ConcreteProduct' class
class ExperiencePage extends Page {
}

//A 'ConcreteProduct' class
class IntroductionPage extends Page {
}

//A 'ConcreteProduct' class
class ResultsPage extends Page {
}

//A 'ConcreteProduct' class
class ConclusionPage extends Page {
}

//A 'ConcreteProduct' class
class SummaryPage extends Page {
}

//A 'ConcreteProduct' class
class BibliographyPage extends Page {
}


// The 'Creator' abstract class
abstract class Document {
	public $pages = array();
	// Factory Method
    public abstract  function CreatePages();
}

// A 'ConcreteCreator' class
class Resume extends Document {
	// Factory Method implementation
    public  function CreatePages() {
      echo "<br/> Creating a resume and adding pages<br/>";
      array_push ($this->pages,get_class(new SkillsPage()));
      array_push ($this->pages,get_class(new EducationPage()));
      array_push ($this->pages,get_class(new ExperiencePage()));
   }
}

// A 'ConcreteCreator' class
class Report extends Document {
	// Factory Method implementation
    public  function CreatePages()
    {
      echo "<br/> Creating a report and adding pages<br/>";
 	  array_push ($this->pages,get_class(new IntroductionPage()));
      array_push ($this->pages,get_class(new ResultsPage()));
      array_push ($this->pages,get_class(new ConclusionPage()));
      array_push ($this->pages,get_class(new SummaryPage()));
      array_push ($this->pages,get_class(new BibliographyPage()));
    }
}

//Implementation
$docs = array('Resume', 'Report');

foreach($docs as $doc) {

	$document = new $doc();
	echo "</br>".get_class($document)."<br/> -------";
	$document->CreatePages();
	foreach ($document->pages as  $page) {
      	echo $page."</br>";
	}

}
?>
