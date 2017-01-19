/*
 Validator v1.1.0
 (c) Yair Even Or
 https://github.com/yairEO/validator
 
 MIT-style license.
 */

var validator = (function($) {
    var message, tests, checkField, validate, mark, unmark, field, minmax, defaults,
            validateWords, lengthRange, lengthLimit, pattern, alertTxt, data,
            email_illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/,
            email_filter = /^.+@.+\..{2,3}$/;

    /* general text messages
     */
    message = {
        invalid: 'invalid input',
        empty: 'campo obligatorio',
        min: 'input is too short',
        max: 'input is too long',
        number_min: 'too low',
        number_max: 'too high',
        url: 'invalid URL',
        number: 'not a number',
        email: 'email no válido',
        email_repeat: 'emails do not match',
        password_repeat: 'passwords do not match',
        repeat: 'no match',
        complete: 'input is not complete',
        select: 'Please select an option',
        cedula: 'cédula incorrecto',
        ruc: 'ruc incorrecto'
    };

    if (!window.console) {
        console = {};
        console.log = console.warn = function() {
            return;
        }
    }

    // defaults
    defaults = {alerts: true};

    /* Tests for each type of field (including Select element)
     */
    tests = {
        sameAsPlaceholder: function(a) {
            return $.fn.placeholder && a.attr('placeholder') !== undefined && data.val == a.prop('placeholder');
        },
        hasValue: function(a) {
            if (!a) {
                alertTxt = message.empty;
                return false;
            }
            return true;
        },
        // 'linked' is a special test case for inputs which their values should be equal to each other (ex. confirm email or retype password)
        linked: function(a, b) {
            if (b != a) {
                // choose a specific message or a general one
                alertTxt = message[data.type + '_repeat'] || message.no_match;
                return false;
            }
            return true;
        },
        email: function(a) {
            if (!email_filter.test(a) || a.match(email_illegalChars)) {
                alertTxt = a ? message.email : message.empty;
                return false;
            }
            return true;
        },
        cedula: function(a) {
            if (ValidarCedula(a) == false) {
                alertTxt = a ? message.cedula : message.empty;
                return false;
            }
            return true;
        },
        ruc: function(a) {
            if (ValidarRuc(a) == false) {
                alertTxt = a ? message.ruc : message.empty;
                return false;
            }
            return true;
        },
        cedula_ruc: function(a) {
            if (a.length <= 10) {
                if (ValidarCedula(a) == false) {
                    alertTxt = a ? message.cedula : message.empty;
                    return false;
                }
            } else {
                if (a.length <= 13) {
                    if (ValidarRuc(a) == false) {
                        alertTxt = a ? message.ruc : message.empty;
                        return false;
                    }
                }
            }
            return true;
        },
        text: function(a) {
            // make sure there are at least X number of words, each at least 2 chars long.
            // for example 'john F kenedy' should be at least 2 words and will pass validation
            if (validateWords) {
                var words = a.split(' ');
                // iterrate on all the words
                var wordsLength = function(len) {
                    for (var w = words.length; w--; )
                        if (words[w].length < len)
                            return false;
                    return true;
                };

                if (words.length < validateWords || !wordsLength(2)) {
                    alertTxt = message.complete;
                    return false;
                }
                return true;
            }
            if (lengthRange && a.length < lengthRange[0]) {
                alertTxt = message.min;
                return false;
            }

            // check if there is max length & field length is greater than the allowed
            if (lengthRange && lengthRange[1] && a.length > lengthRange[1]) {
                alertTxt = message.max;
                return false;
            }
            // check if the field's value should obey any length limits, and if so, make sure the length of the value is as specified
            if (lengthLimit && lengthLimit.length) {
                var obeyLimit = false;
                while (lengthLimit.length) {
                    if (lengthLimit.pop() == a.length)
                        obeyLimit = true;
                }
                if (!obeyLimit) {
                    alertTxt = message.complete;
                    return false;
                }
            }

            if (pattern) {
                var regex, jsRegex;
                switch (pattern) {
                    case 'alphanumeric' :
                        regex = /^[a-z0-9]+$/i;
                        break;
                    case 'numeric' :
                        regex = /^[0-9]+$/i;
                        break;
                    case 'phone' :
                        regex = /^\+?([0-9]|[-|' '])+$/i;
                        break;
                    default :
                        regex = pattern;
                }
                try {
                    jsRegex = new RegExp(regex).test(a);
                    if (a && !jsRegex)
                        return false;
                }
                catch (err) {
                    console.log(err, field, 'regex is invalid');
                    return false;
                }
            }
            return true;
        },
        number: function(a) {
            // if not not a number
            if (isNaN(parseFloat(a)) && !isFinite(a)) {
                alertTxt = message.number;
                return false;
            }
            // not enough numbers
            else if (lengthRange && a.length < lengthRange[0]) {
                alertTxt = message.min;
                return false;
            }
            // check if there is max length & field length is greater than the allowed
            else if (lengthRange && lengthRange[1] && a.length > lengthRange[1]) {
                alertTxt = message.max;
                return false;
            }
            else if (minmax[0] && (a | 0) < minmax[0]) {
                alertTxt = message.number_min;
                return false;
            }
            else if (minmax[1] && (a | 0) > minmax[1]) {
                alertTxt = message.number_max;
                return false;
            }
            return true;
        },
        // Date is validated in European format (day,month,year)
        date: function(a) {
            var day, A = a.split(/[-./]/g), i;
            // if there is native HTML5 support:
            if (field[0].valueAsNumber)
                return true;

            for (i = A.length; i--; ) {
                if (isNaN(parseFloat(a)) && !isFinite(a))
                    return false;
            }
            try {
                day = new Date(A[2], A[1] - 1, A[0]);
                if (day.getMonth() + 1 == A[1] && day.getDate() == A[0])
                    return day;
                return false;
            }
            catch (er) {
                console.log('date test: ', err);
                return false;
            }
        },
        url: function(a) {
//			// minimalistic URL validation
            function testUrl(url) {
                return /^(https?:\/\/)?([\w\d\-_]+\.+[A-Za-z]{2,})+\/?/.test(url);
            }
            if (!testUrl(a)) {
                console.log(a);
                alertTxt = a ? message.url : message.empty;
                return false;
            }

        },
        hidden: function(a) {
            if (lengthRange && a.length < lengthRange[0]) {
                alertTxt = message.min;
                return false;
            }
            if (pattern) {
                var regex;
                if (pattern == 'alphanumeric') {
                    regex = /^[a-z0-9]+$/i;
                    if (!regex.test(a)) {
                        return false;
                    }
                }
            }
            return true;
        },
        select: function(a) {
            if (!tests.hasValue(a)) {
                alertTxt = message.select;
                return false;
            }
            return true;
        }
    };

    /* marks invalid fields
     */
    mark = function(field, text) {
        if (!text || !field || !field.length)
            return false;

        // check if not already marked as a 'bad' record and add the 'alert' object.
        // if already is marked as 'bad', then make sure the text is set again because i might change depending on validation
        var item = field.parents('.item'),
                warning;

        if (item.hasClass('bad')) {
            if (defaults.alerts)
                item.find('.alert').html(text);
        }


        else if (defaults.alerts) {
            warning = $('<div class="alert">').html(text);
            item.append(warning);
        }

        item.removeClass('bad');
        // a delay so the "alert" could be transitioned via CSS
        setTimeout(function() {
            item.addClass('bad');
        }, 0);
    };
    /* un-marks invalid fields
     */
    unmark = function(field) {
        if (!field || !field.length) {
            console.warn('no "field" argument, null or DOM object not found');
            return false;
        }

        field.parents('.item')
                .removeClass('bad')
                .find('.alert').remove();
    };

    function testByType(type, value) {
        if (type == 'tel')
            pattern = pattern || 'phone';

        if (!type || type == 'password' || type == 'tel')
            type = 'text';

        return tests[type](value);
    }

    function prepareFieldData(el) {
        field = $(el);

        field.data('valid', true);				// initialize validness of field by first checking if it's even filled out of now
        field.data('type', field.attr('type'));	// every field starts as 'valid=true' until proven otherwise
        pattern = el.pattern;
    }

    /* Validations per-character keypress
     */
    function keypress(e) {
        prepareFieldData(this);

        if (e.charCode)
            return testByType(data.type, String.fromCharCode(e.charCode));
    }

    /* Checks a single form field by it's type and specific (custom) attributes
     */
    function checkField() {
        // skip testing fields whom their type is not HIDDEN but they are HIDDEN via CSS.
        if (this.type != 'hidden' && $(this).is(':hidden'))
            return true;

        prepareFieldData(this);

        field.data('val', field[0].value.replace(/^\s+|\s+$/g, ""));	// cache the value of the field and trim it
        data = field.data();

        // Check if there is a specific error message for that field, if not, use the default 'invalid' message
        alertTxt = message[field.prop('name')] || message.invalid;

        // SELECT / TEXTAREA nodes needs special treatment
        if (field[0].nodeName.toLowerCase() === "select") {
            data.type = 'select';
        }
        if (field[0].nodeName.toLowerCase() === "textarea") {
            data.type = 'text';
        }
        /* Gather Custom data attributes for specific validation:
         */
        validateWords = data['validateWords'] || 0;
        lengthRange = data['validateLengthRange'] ? (data['validateLengthRange'] + '').split(',') : [1];
        lengthLimit = data['validateLength'] ? (data['validateLength'] + '').split(',') : false;
        minmax = data['validateMinmax'] ? (data['validateMinmax'] + '').split(',') : ''; // for type 'number', defines the minimum and/or maximum for the value as a number.

        data.valid = tests.hasValue(data.val);
        // check if field has any value
        if (data.valid) {
            /* Validate the field's value is different than the placeholder attribute (and attribute exists)
             * this is needed when fixing the placeholders for older browsers which does not support them.
             * in this case, make sure the "placeholder" jQuery plugin was even used before proceeding
             */
            if (tests.sameAsPlaceholder(field)) {
                alertTxt = message.empty;
                data.valid = false;
            }

            // if this field is linked to another field (their values should be the same)
            if (data.validateLinked) {
                var linkedTo = data['validateLinked'].indexOf('#') == 0 ? $(data['validateLinked']) : $(':input[name=' + data['validateLinked'] + ']');
                data.valid = tests.linked(data.val, linkedTo.val());
            }
            /* validate by type of field. use 'attr()' is proffered to get the actual value and not what the browsers sees for unsupported types.
             */
            else if (data.valid || data.type == 'select')
                data.valid = testByType(data.type, data.val);

            // optional fields are only validated if they are not empty
            if (field.hasClass('optional') && !data.val)
                data.valid = true;
        }

        // mark / unmark the field, and set the general 'submit' flag accordingly
        if (data.valid)
            unmark(field);
        else {
            mark(field, alertTxt);
            submit = false;
        }

        return data.valid;
    }

    /* vaildates all the REQUIRED fields prior to submiting the form
     */
    function checkAll($form) {
        $form = $($form);

        if ($form.length == 0) {
            console.warn('element not found');
            return false;
        }

        var that = this,
                submit = true, // save the scope
                fieldsToCheck = $form.find(':input').filter('[required=required], .required, .optional').not('[disabled=disabled]');

        fieldsToCheck.each(function() {
            // use an AND operation, so if any of the fields returns 'false' then the submitted result will be also FALSE
            submit = submit * checkField.apply(this);
        });

        return !!submit;  // casting the variable to make sure it's a boolean
    }

    return {
        defaults: defaults,
        checkField: checkField,
        keypress: keypress,
        checkAll: checkAll,
        mark: mark,
        unmark: unmark,
        message: message,
        tests: tests
    }
})(jQuery);

//proceso para validar cedula ecuatoriana
function ValidarCedula(cedula) {
    var validador = false;
    if (cedula.length != 10) {
        return validador;
    }
    //Obtenemos el digito de la region que sonlos dos primeros digitos
    var digito_region = cedula.substring(0, 2);

    //Pregunto si la region existe ecuador se divide en 24 regiones
    if (digito_region >= 1 && digito_region <= 24) {

        // Extraigo el ultimo digito
        var ultimo_digito = cedula.substring(9, 10);

        //Agrupo todos los pares y los sumo
        var pares = parseInt(cedula.substring(1, 2)) + parseInt(cedula.substring(3, 4)) + parseInt(cedula.substring(5, 6)) + parseInt(cedula.substring(7, 8));

        //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
        var numero1 = cedula.substring(0, 1);
        var numero1 = (numero1 * 2);
        if (numero1 > 9) {
            var numero1 = (numero1 - 9);
        }

        var numero3 = cedula.substring(2, 3);
        var numero3 = (numero3 * 2);
        if (numero3 > 9) {
            var numero3 = (numero3 - 9);
        }

        var numero5 = cedula.substring(4, 5);
        var numero5 = (numero5 * 2);
        if (numero5 > 9) {
            var numero5 = (numero5 - 9);
        }

        var numero7 = cedula.substring(6, 7);
        var numero7 = (numero7 * 2);
        if (numero7 > 9) {
            var numero7 = (numero7 - 9);
        }

        var numero9 = cedula.substring(8, 9);
        var numero9 = (numero9 * 2);
        if (numero9 > 9) {
            var numero9 = (numero9 - 9);
        }

        var impares = numero1 + numero3 + numero5 + numero7 + numero9;

        //Suma total
        var suma_total = (pares + impares);

        //extraemos el primero digito
        var primer_digito_suma = String(suma_total).substring(0, 1);

        //Obtenemos la decena inmediata
        var decena = (parseInt(primer_digito_suma) + 1) * 10;

        //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
        var digito_validador = decena - suma_total;

        //Si el digito validador es = a 10 toma el valor de 0
        if (digito_validador == 10)
            var digito_validador = 0;

        //Validamos que el digito validador sea igual al de la cedula
        if (digito_validador == ultimo_digito) {
            //document.write('cedula correcto!!!!');
            validador = true;
            //alert("cedula correcto");
            //console.log('la cedula:' + cedula + ' es correcta');
        } else {
            //console.log('la cedula:' + cedula + ' es incorrecta');
            //document.write('cedula incorrecto');
            return validador;
            // alert("cedula no valida");
        }

    } else {
        // imprimimos en consola si la region no pertenece
        // document.write('Esta cedula no pertenece a ninguna region');
        // console.log('Esta cedula no pertenece a ninguna region');
        return validador;
    }
    return validador;
}

//proceso para validar un ruc
function ValidarRuc(ruc) {
    var validador = false;
    var digito3;
    var i;
    //var ruc; //asignar elemento id de formulario
    var cadenar;
    var digito;
    var suma = 0;
    var d;
    var c;
    var ver;
    //ruc = document.getElementById("ruc").value;
    if (ruc.length != 13) {
        return validador;
    }
   
    digito3 = ruc.substring(2, 3);
    if (digito3 < 6) {
        for (i = 1; i < 10; i++) {
            if (i % 2 == 0) {
                cadenar = ruc.substring(i - 1, i);
                suma += parseInt(cadenar);
            } else {
                cadenar = ruc.substring(i - 1, i);
                cadenar = parseInt(cadenar) * 2;
                if (cadenar > 9) {
                    cadenar -= 9;
                    suma += parseInt(cadenar);
                } else {
                    suma += parseInt(cadenar);
                }
            }
        }
        c = suma.toString();
        d = c.substring(0, 1);
        d = d + 0;
        c = parseInt(d);
        d = c + 10;
        digito = d - parseInt(suma);
        ver = ruc.substring(9, 10);
        if (digito != ver) {
            //alert("el ruc es incorrecto");
            return validador;
        } else {
            //alert("ESte ruc pertenece a personas naturales");
            validador = true;
        }
    } else {
        if (digito3 == 6) {
            var psuma = 0;
            var pcadena = 0;
            var p;
            var presiduo;
            var pveri;
            for (p = 1; p < 9; p++) {
                if (p == 1) {
                    pcadena = ruc.substring(p - 1, p);
                    pcadena = parseInt(pcadena) * 3;
                    psuma += parseInt(pcadena);
                } else {
                    if (p == 2) {
                        pcadena = ruc.substring(p - 1, p);
                        pcadena = parseInt(pcadena) * 2;
                        psuma += parseInt(pcadena);
                    } else {
                        if (p == 3) {
                            pcadena = ruc.substring(p - 1, p);
                            pcadena = parseInt(pcadena) * 7;
                            psuma += parseInt(pcadena);
                        } else {
                            if (p == 4) {
                                pcadena = ruc.substring(p - 1, p);
                                pcadena = parseInt(pcadena) * 6;
                                psuma += parseInt(pcadena);
                            } else {
                                if (p == 5) {
                                    pcadena = ruc.substring(p - 1, p);
                                    pcadena = parseInt(pcadena) * 5;
                                    psuma += parseInt(pcadena);
                                } else {
                                    if (p == 6) {
                                        pcadena = ruc.substring(p - 1, p);
                                        pcadena = parseInt(pcadena) * 4;
                                        psuma += parseInt(pcadena);
                                    } else {
                                        if (p == 7) {
                                            pcadena = ruc.substring(p - 1, p);
                                            pcadena = parseInt(pcadena) * 3;
                                            psuma += parseInt(pcadena);
                                        } else {
                                            if (p == 8) {
                                                pcadena = ruc.substring(p - 1, p);
                                                pcadena = parseInt(pcadena) * 2;
                                                psuma += parseInt(pcadena);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }//llave de for endfor
            presiduo = (psuma % 11);
            presiduo = 11 - presiduo;
            pveri = ruc.substring(8, 9);
            if (presiduo != pveri) {
                //alert("el ruc es incorrecto");
                return validador;
            } else {
                // alert("ESTE RUC pertenece a personas publicas");
                validador = true;
            }
        } else {
            if (digito3 == 9) {
                var jsuma = 0;
                var jcadena = 0;
                var j;
                var jresiduo;
                var jveri;
                for (j = 1; j < 10; j++) {
                    if (j == 1) {
                        jcadena = ruc.substring(j - 1, j)
                        jcadena = parseInt(jcadena) * 4;
                        jsuma += parseInt(jcadena);
                    } else {
                        if (j == 2) {
                            jcadena = ruc.substring(j - 1, j)
                            jcadena = parseInt(jcadena) * 3;
                            jsuma += parseInt(jcadena);
                        } else {
                            if (j == 3) {
                                jcadena = ruc.substring(j - 1, j)
                                jcadena = parseInt(jcadena) * 2;
                                jsuma += parseInt(jcadena);
                            } else {
                                if (j == 4) {
                                    jcadena = ruc.substring(j - 1, j)
                                    jcadena = parseInt(jcadena) * 7;
                                    jsuma += parseInt(jcadena);
                                } else {
                                    if (j == 5) {
                                        jcadena = ruc.substring(j - 1, j)
                                        jcadena = parseInt(jcadena) * 6;
                                        jsuma += parseInt(jcadena);
                                    } else {
                                        if (j == 6) {
                                            jcadena = ruc.substring(j - 1, j)
                                            jcadena = parseInt(jcadena) * 5;
                                            jsuma += parseInt(jcadena);
                                        } else {
                                            if (j == 7) {
                                                jcadena = ruc.substring(j - 1, j)
                                                jcadena = parseInt(jcadena) * 4;
                                                jsuma += parseInt(jcadena);
                                            } else {
                                                if (j == 8) {
                                                    jcadena = ruc.substring(j - 1, j)
                                                    jcadena = parseInt(jcadena) * 3;
                                                    jsuma += parseInt(jcadena);

                                                } else {
                                                    if (j == 9) {
                                                        jcadena = ruc.substring(j - 1, j)
                                                        jcadena = parseInt(jcadena) * 2;
                                                        jsuma += parseInt(jcadena);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }//end for
                jresiduo = (jsuma % 11);
                jresiduo = 11 - jresiduo;
                jveri = ruc.substring(9, 10);
                if (jresiduo != jveri) {
                    //alert("el ruc es incorrecto");
                    return validador;
                } else {
                    // alert("ESTE RUC pertenece a personas JURIDICAS");
                    validador = true;
                }
            }//end if 
        }
    }
    return validador;
}