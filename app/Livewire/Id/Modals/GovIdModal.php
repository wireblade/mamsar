<?php

namespace App\Livewire\Id\Modals;

use App\Models\Employee;
use Livewire\Attributes\On;
use Livewire\Component;

class GovIdModal extends Component
{

    public $openModal = false;

    public $sss_no = '';
    public $tin_no = '';
    public $pagibig_no = '';
    public $philhealth_no = '';

    public $firstName = '';
    public $middleName = '';
    public $lastName = '';
    public $fullName = '';
    
    #[On('open-gov-id-modal')]
    public function openModal($id)
    {
        $this->openModal = true;

        $data = Employee::findOrFail($id);

        $this->sss_no = $data->govId?->sss_no ?: 'N/A';
        $this->tin_no = $data->govId?->tin_no ?: 'N/A';
        $this->pagibig_no = $data->govId?->pagibig_no ;
        $this->philhealth_no = $data->govId?->philhealth_no ?: 'N/A';

        $this->firstName = strtoupper($data->fname);
        $this->middleName = strtoupper($data->mname);
        $this->lastName = strtoupper($data->lname);
        $this->fullName = strtoupper($data->fname). ' ' . strtoupper(substr($data->mname, 0, 1)) . '. ' . strtoupper($data->lname);
        
    }
    
    public function getFirstInitials(int $length = 1): string
    {
        return strtoupper(substr($this->firstName, 0, $length));
    }

    public function getMiddleInitials(int $length = 1): string
    {
        return strtoupper(substr($this->middleName, 0, $length));
    }

    public function getLastInitials(int $length = 1): string
    {
        return strtoupper(substr($this->lastName, 0, $length));
    }
        public function getFullName()
    {
        $middle = $this->getMiddleInitials() != '' ? $this->getMiddleInitials() . '. ' : '';

        return $this->firstName . ' '.  $middle . ' ' . $this->lastName;
    }
    
    public function render()
    {
        return view('livewire.id.modals.gov-id-modal');
    }
}
