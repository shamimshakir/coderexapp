<?php


if (!function_exists('abort')) {
    /**
     * @throws Exception
     */
    function abort($code = 404): false|string
    {
        http_response_code($code);

        return view("errors/$code.view");
    }
}


if (!function_exists('view')) {
    function view($path, $context = []): false|string
    {
        // Extract the data array into variables for use in the view
        extract($context);

        // Get the full path to the view file
        $viewFullPath = BASE_PATH .
            DIRECTORY_SEPARATOR .
            "views" .
            DIRECTORY_SEPARATOR .
            $path . ".php";
        // Check if the view file exists
        if (!file_exists($viewFullPath)) {
            throw new \Exception('View file not found: ' . $path);
        }

        // Start output buffering
//        ob_start();

        include $viewFullPath;

        // Get the contents of the output buffer and clean it
        $viewContent = ob_get_clean();

        // Return the view content
        return $viewContent;
    }
}