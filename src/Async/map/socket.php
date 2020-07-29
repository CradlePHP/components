<?php //-->

return function ($handler) {
  register_shutdown_function(function () use ($handler) {
    $error = error_get_last();
    if (!$error || ($error['type'] ^ E_ERROR)) {
      $handler->run();
    }
  });
};
