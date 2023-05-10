<?php

declare(strict_types=1);
    class VerbrauchsdatenJahr extends IPSModule
    {
        private $months = [
            'january',
            'february',
            'march',
            'april',
            'may',
            'june',
            'july',
            'august',
            'september',
            'october',
            'november',
            'december'
        ];

        public function Create()
        {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyBoolean('Active', false);
            $this->RegisterPropertyInteger('VariableID', 0);
            $this->RegisterPropertyInteger('Year', 0);

            $this->RegisterPropertyInteger('UpdateInterval', 600);
            $this->RegisterTimer('VD_Update', 0, 'VD_Update($_IPS[\'TARGET\']);');
        }

        public function Destroy()
        {
            //Never delete this line!
            parent::Destroy();
        }

        public function ApplyChanges()
        {
            //Never delete this line!
            parent::ApplyChanges();

            if ($this->ReadPropertyInteger('VariableID') == 0) {
                $this->SetStatus(201);
                return;
            }

            //Variables
            $Variable = IPS_GetVariable($this->ReadPropertyInteger('VariableID'));
            $Profile = '';
            if ($Variable['VariableProfile'] != '') {
                $Profile = $Variable['VariableProfile'];
            }
            if ($Variable['VariableCustomProfile'] != '') {
                $Profile = $Variable['VariableCustomProfile'];
            }

            $i = 0;
            foreach ($this->months as $month) {
                $this->RegisterVariableFloat($month, $this->Translate(ucfirst($month)).' '. $this->ReadPropertyInteger('Year'),$Profile,$i);
                $i++;
            }

            //Register UpdateTimer
            if ($this->ReadPropertyBoolean('Active')) {
                $this->SetTimerInterval('VD_Update', $this->ReadPropertyInteger('UpdateInterval') * 1000);
                $this->Update();
                $this->SetStatus(102);
            } else {
                $this->SetTimerInterval('VD_Update', 0);
                $this->SetStatus(104);
            }
        }

        public function Update()
        {
            $archiveID = IPS_GetInstanceListByModuleID('{43192F0B-135B-4CE7-A0A7-1475603F3060}')[0];
            $variableID = $this->ReadPropertyInteger('VariableID');


            foreach ($this->months as $month) {
                $this->SendDebug($month. ' Start Date', 'first day of '.$month. ' ' .$this->ReadPropertyInteger('Year'). ' 00:00:00', 0);
                $this->SendDebug($month. ' Start Date', 'last day of  '.$month. ' ' .$this->ReadPropertyInteger('Year'). ' 23:59:59',0);
                $values = AC_GetAggregatedValues($archiveID, $variableID, 3, strtotime('first day of '.$month. ' ' .$this->ReadPropertyInteger('Year'). ' 00:00:00'),  strtotime('last day of  '.$month. ' ' .$this->ReadPropertyInteger('Year'). ' 23:59:59'), 0);           
                if (count($values) > 0) {
                    $this->SetValue($month, $values[0]['Avg']);
                } else {
                    $this->SetValue($month, 0);
                }           
            }
        }
    }