<?php

class EmailApi {

    public function sendEmail($subject, $body, $fromAddress, $toAddress, $statusCd = 'pending') {

        $emailInstance = new \TheFarm\Models\EmailInstance();
        $emailInstance->setEmailSubject($subject);
        $emailInstance->setEmailBody($body);
        $emailInstance->setFromEmailAddress($fromAddress);
        $emailInstance->setToEmailAddress($toAddress);
        $emailInstance->setEmailStatusCd($statusCd);
        $emailInstance->save();

        return $emailInstance->toArray();

    }


}