<?php
namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\CheckBox;
use Nette\Forms\Controls\Select;

final class FormFactory 
{
    use Nette\SmartObject;

    public function create(): Form {
        $form = new Form;
        $form->onRender[] = [$this, 'makeUIKIT'];
	return $form;
    }
    
    function makeUIKIT(Form $form): void
    {
        $renderer = $form->getRenderer();
        $renderer->wrappers['controls']['container'] = 'fieldset class="uk-fieldset"';
        $renderer->wrappers['pair']['container'] = 'div class="uk-margin"';
        $renderer->wrappers['label']['container'] = 'div class="uk-form-label"';
        $renderer->wrappers['control']['container'] = 'div class="uk-form-controls"';

        foreach ($form->getControls() as $control) {
            $type = $control->getOption('type');
            if($type === 'button') {
                $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'uk-button uk-button-primary' : 'uk-button uk-button-secondary');
                $usedPrimary = true;
            } elseif ($type === 'text') {
                $control->getControlPrototype()->addClass('uk-input');
            } elseif ($type === 'select') {
                $control->getControlPrototype()->addClass('uk-select');
            } elseif ($type === 'textarea') {
                $control->getControlPrototype()->addClass('uk-textarea');
            } elseif ($type === 'checkbox') {
                $control->getControlPrototype()->addClass('uk-checkbox');
            } elseif ($type === 'radiobox') {
                $control->getControlPrototype()->addClass('uk-radio');
            } elseif ($type === 'file') {
                $control->getControlPrototype()->addClass('uk-form-custom');
            }
        }
    }
}
