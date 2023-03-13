<?php

namespace App\Http\Traits;

trait ReplacePlaceholderTrait {


    /**
     * Replaces title placeholders in a string with their corresponding values.
     *
     * @param array $placeholders An array of title placeholders to replace.
     * @param string $templateTitle The string to replace the placeholders in.
     * @param string $tenantName The value to replace the '[tenant_name]' placeholder with.
     * @param string $mailDate The value to replace the '[start_date]' placeholder with.
     * @return string The updated string.
     */
    function replaceKeyWithValue(array $placeholders, string $template, string $tenantName = "", string $mailDate = ""): string
    {
        foreach ($placeholders as $titlePlaceHolder) {
            switch ($titlePlaceHolder) {
                case '[tenant_name]':
                    $template = str_replace($titlePlaceHolder, $tenantName, $template);
                    break;
                case '[start_date]':
                    $template = str_replace($titlePlaceHolder, $mailDate, $template);
                    break;
                // add more cases for other placeholders as needed
            }
        }

        return $template;
    }
    function generatePlaceholders($mail_template_hashtag) {
        $placeholders = [];

        foreach ($mail_template_hashtag as $key => $value) {
            $placeholders["[$key]"] = $value;
        }

        return $placeholders;
    }
}
