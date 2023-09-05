<?php

namespace Core;
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?') ?? false;
        return $position ? substr($path, 0, $position) : $path;
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isPost(): bool
    {
        return $this->getMethod() == 'post';
    }

    public function isGet(): bool
    {
        return $this->getMethod() == 'get';
    }

    public function getBody(): array
    {
        $body = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value)
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if ($this->isPost()) {
            foreach ($_POST as $key => $value)
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if ($this->isPost() && !is_null($_FILES)) {
            $keys = array_keys($_FILES);
            $filteredFile = [];
            foreach ($keys as $key) {
                foreach ($_FILES[$key] as $index => $fileInfo) {
                    $filteredFile[$index] = filter_var($fileInfo, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                $body[$key][] = $filteredFile;
            }
        }
        return $body;
    }
}

