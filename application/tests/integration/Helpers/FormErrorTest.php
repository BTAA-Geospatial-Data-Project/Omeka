<?php
/**
 * @version $Id$
 * @copyright Center for History and New Media, 2010
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @package Omeka
 **/

require_once HELPERS;

/**
 * Test for the form_error() helper.
 *
 * @package Omeka
 * @copyright Center for History and New Media, 2010
 **/
class Omeka_Helper_FormErrorTest extends Omeka_Test_AppTestCase
{
    
    public function setUp()
    {
        parent::setUp();
        $this->flash = new Omeka_Controller_Flash;
    }
    
    public function testFormErrorReturnsNullIfStringFlashed()
    {
        $this->flash->setFlash(Omeka_Controller_Flash::VALIDATION_ERROR, 
                               "foobar", 
                               Omeka_Controller_Flash::DISPLAY_NOW);
        
        $this->assertNull(form_error('name'));
    }
    
    public function testFormErrorReturnsCorrectlyIfArrayFlashed()
    {
        $this->flash->setFlash(Omeka_Controller_Flash::VALIDATION_ERROR, 
                               array('name' => 'No name given'), 
                               Omeka_Controller_Flash::DISPLAY_NOW);
        
        $this->assertEquals('<div class="error">No name given</div>', 
                            form_error('name'));
    }
    
    public function testFormErrorReturnsCorrectlyIfOmekaValidatorErrorsFlashed()
    {
        $this->flash->setFlash(Omeka_Controller_Flash::VALIDATION_ERROR, 
                               new Omeka_Validator_Errors(array('name' => 'No name given')), 
                               Omeka_Controller_Flash::DISPLAY_NOW);
        
        $this->assertEquals('<div class="error">No name given</div>', 
                           form_error('name'));
    }
}
