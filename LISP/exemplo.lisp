(write-line "Hello World")
(write '(* 2 3))
(write-line "")
(write (* 2 3))

; Macro

(defmacro setTo10(num)
(setq num 10)(print num)
)
(setq x 25)
(print x)
(setTo10 y)

;Constrains

(defconstant PI 3.141592)
(defun area-circulo(rad)
	(terpri)
	(format t "Radianos: ~5f" rad)
	(format t "~%Area: ~10f" (* PI rad rad))
)
(area-circulo 10)