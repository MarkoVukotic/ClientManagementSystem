<?php
function output($trueOrFalse)
{
    try {
        if ($trueOrFalse) {
            $output = [
                'status' => 'success',
                'message' => 'Akcija je uspjesno izvrsena',
                'data' => $trueOrFalse
            ];
        } else {
            $output = [
                'status' => 'error',
                'message' => 'Akcija je neuspjesno izvrsena',
                'data' => null
            ];
        }
        return json_encode($output);
    } catch (Exception $exception) {
        echo $exception->getMessage();
    }
}
