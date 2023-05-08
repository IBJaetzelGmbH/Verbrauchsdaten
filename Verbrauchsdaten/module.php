<?php

declare(strict_types=1);
    class Verbrauchsdaten extends IPSModule
    {
        public function Create()
        {
            //Never delete this line!
            parent::Create();

            $this->RegisterPropertyBoolean('Active', false);
            $this->RegisterPropertyInteger('VariableID', 0);

            $this->RegisterPropertyBoolean('today', true);
            $this->RegisterPropertyBoolean('yesterday', true);
            $this->RegisterPropertyBoolean('currentWeek', true);
            $this->RegisterPropertyBoolean('lastWeek', true);
            $this->RegisterPropertyBoolean('currentMonth', true);
            $this->RegisterPropertyBoolean('lastMonth', true);
            $this->RegisterPropertyBoolean('currentYear', true);
            $this->RegisterPropertyBoolean('lastYear', true);

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

            $this->MaintainVariable('today', $this->Translate('Today'), 2, $Profile, 0, $this->ReadPropertyBoolean('today') == true);
            $this->MaintainVariable('yesterday', $this->Translate('Yesterday'), 2, $Profile, 1, $this->ReadPropertyBoolean('yesterday') == true);
            $this->MaintainVariable('currentWeek', $this->Translate('Current Week'), 2, $Profile, 2, $this->ReadPropertyBoolean('currentWeek') == true);
            $this->MaintainVariable('lastWeek', $this->Translate('Last Week'), 2, $Profile, 3, $this->ReadPropertyBoolean('lastWeek') == true);
            $this->MaintainVariable('currentMonth', $this->Translate('Current Month'), 2, $Profile, 4, $this->ReadPropertyBoolean('currentMonth') == true);
            $this->MaintainVariable('lastMonth', $this->Translate('Last Month'), 2, $Profile, 5, $this->ReadPropertyBoolean('lastMonth') == true);
            $this->MaintainVariable('currentYear', $this->Translate('Current Year'), 2, $Profile, 6, $this->ReadPropertyBoolean('currentYear') == true);
            $this->MaintainVariable('lastYear', $this->Translate('Last Year'), 2, $Profile, 7, $this->ReadPropertyBoolean('lastYear') == true);

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

            if ($this->ReadPropertyBoolean('today')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 1, strtotime('today 00:00'), time(), 0);
                if (count($values) > 0) {
                    $this->SetValue('today', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('yesterday')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 1, strtotime('yesterday 00:00'), strtotime('yesterday 23:59:59'), 0);
                if (count($values) > 0) {
                    $this->SetValue('yesterday', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('currentWeek')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 2, strtotime('Midnight Monday this week'), strtotime('Midnight Sunday this week'), 0);
                if (count($values) > 0) {
                    $this->SetValue('currentWeek', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('lastWeek')) {
                //Letzte Woche ermitteln
                $strCurDate = 'monday this week';
                $prevWeek = date_create($strCurDate)->modify('-1 week');
                $mondayLastWeek = $prevWeek->getTimestamp();

                $prevWeek->modify('+7 days - 1 second');
                $sundayLastWeek = $prevWeek->getTimestamp();

                $values = AC_GetAggregatedValues($archiveID, $variableID, 2, $mondayLastWeek, $sundayLastWeek, 0);
                if (count($values) > 0) {
                    $this->SetValue('lastWeek', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('currentMonth')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 3, strtotime('midnight first day of this month'), strtotime('last day of this month 23:59:59'), 0);
                if (count($values) > 0) {
                    $this->SetValue('currentMonth', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('lastMonth')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 3, strtotime('midnight first day of this month - 1 month'), strtotime('last day of this month 23:59:59 -1 month'), 0);
                if (count($values) > 0) {
                    $this->SetValue('lastMonth', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('currentYear')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 4, strtotime('midnight first day of january this year'), strtotime('last day of december this year 23:59:59'), 0);
                if (count($values) > 0) {
                    $this->SetValue('currentYear', $values[0]['Avg']);
                }
            }
            if ($this->ReadPropertyBoolean('lastYear')) {
                $values = AC_GetAggregatedValues($archiveID, $variableID, 4, strtotime('midnight first day of january last year'), strtotime('last day of december last year 23:59:59'), 0);
                if (count($values) > 0) {
                    $this->SetValue('lastYear', $values[0]['Avg']);
                }
            }
        }
    }