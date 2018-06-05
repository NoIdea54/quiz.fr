// <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
// ------------------------------- Début Fonctions Quiz ----------------------------- //

// globale quiz : contient le quiz actuellement en json, globale pour permettre de naviguer dans le quiz
// globale reponse_quiz : contient la reponse d'un quiz en json

// A FAIRE : Fonction > json_encode a l'affichage = Tableau en json
var quiz;
var reponse_quiz;
var test_quiz = 
{
	"id" : 1,
	"titre" : "Titre de mon quiz",
	"nb_question" : 3,
	"id_membre" : 87,
	"questions" : 
	[
		{
			"id" : 1,
			"numero_question" : 1,
			"text" : "En quelle année a été créé Univers Freebox ?",
			"multi" : false,
			"temps_reponse" : 60000,
			"reponses" : 
			[
				{
					"id" : 1,
					"numero_reponse" : 1,
					"text" : "2000"
				},
				{
					"id" : 2,
					"numero_reponse" : 2,
					"text" : "2005"
				},
				{
					"id" : 3,
					"numero_reponse" : 3,
					"text" : "2007"
				}
			]
		},
		{
			"id" : 2,
			"numero_question" : 2,
			"text" : "Quelles couleurs sont présentes sur le drapeau de la France ?",
			"multi" : true,
			"temps_reponse" : 60000,
			"reponses" : 
			[
				{
					"id" : 4,
					"numero_reponse" : 1,
					"text" : "Blanc"
				},
				{
					"id" : 5,
					"numero_reponse" : 2,
					"text" : "Bleu"
				},
				{
					"id" : 6,
					"numero_reponse" : 3,
					"text" : "Vert"
				},
				{
					"id" : 7,
					"numero_reponse" : 4,			
					"text" : "Rouge"
				}
			]
		},
		{
			"id" : 3,
			"numero_question" : 3,
			"text" : "Quelle(s) est/sont le(s) nom(s) de domaine d'Univers Freebox ?",
			"multi" : true,
			"temps_reponse" : 60000,
			"reponses" : 
			[
				{
					"id" : 8,
					"numero_reponse" : 1,
					"text" : "www.universfreebox.fr"
				},
				{
					"id" : 9,
					"numero_reponse" : 2,
					"text" : "www.freenews.fr"
				},
				{
					"id" : 10,
					"numero_reponse" : 3,
					"text" : "www.freezone.fr"
				},
				{
					"id" : 11,
					"numero_reponse" : 4,
					"text" : "www.universfreebox.com"
				}
			]
		}
	]
};

$().ready(function() 
{
	print_quiz($_GET[id], 1);
});

function generer_nouveau_quiz()
{
	nb_question = $("#quiz_nb_question").find(":selected").val();
	titre = $("#quiz_titre").val();
	quiz
	
	var ask = window.confirm("Souhaitez-vous vraiment créer un nouveau quiz ?");
	if (ask)
	{
		var parameters = {
			nb_question : nb_question,
			requete : 'nouveau_quiz',
			titre : titre
        }
        $.ajax(
		{
            url: '/ajax.php?page=services/requete_quiz.php',
            type: 'post',
            dataType: 'json',
            success: function (data) 
			{
				if(data != 'ko')
				{
					// alert(data);
					// response = JSON.parse(data);
					 // Le membre est connecté. Ajoutons lui un message dans la page HTML.
					 // $("#com_"+id_comment).remove();
					 // alert(data);
					 $("#quiz_div").html(data["html"]);
					 $("#quiz_div").attr("value",data["id_quiz"]);
				}
				else
				{
					 // Le membre n'a pas été connecté. (data vaut ici "failed")
					 $("#resultat").html("<p>Erreur lors de la connexion...</p>");
				}
            },
            data: parameters
        });
	}
}


$('#quiz_numero_question').change(function() 
{
    maj_quiz("changement_question");
});

$('#quiz_numero_question').change(function() 
{
    maj_quiz("changement_reponse");
});
function maj_quiz(contexte)
{
	if(contexte == '')
	{
		
	}
	else if(contexte = "ajout_reponse")
	{
		
	}
	else if(contexte = "changement_question")
	{
		// modification du champs avec la question
		question_courante = $("#quiz_numero_question").find(":selected").val();
		reponse_courante = $("#quiz_numero_reponse").find(":selected").val();
		
		reponse_html = '';
		$.each(reponse_quiz.questions, function(indice_question, question) 
		{
			if(question.numero_question == question_courante)
			{
				if(question.multi == true)
				{
					$("#reponse_muliple").val() = "on";
					type = 'checkbox';
				}
				else
				{
					$("#reponse_muliple").val() = "";
					type = 'radio';
				}
				$.each(question.reponses, function(indice_reponse, reponse) 
				{
					reponse_html += '<input type="' + type + '" id="reponse_' + reponse.numero_reponse + '" name="reponse" value="' + reponse.id + '">';
					reponse_html += '<label for="reponse_' + reponse.numero_reponse + '">' + reponse.text + '</label>';
				});
			}
			else if(question.numero_question == numero_question + 1)
			{
				bouton = '<input type="button" onclick="print_quiz(quiz, ' + (question.numero_question) + ');return false;" class="bt_bouton fright" value="Valider"/>';
			}
		});
		
		$("#quiz_numero_reponse").html(reponse_html);
	}
	else if(contexte = "changement_reponse")
	{
		
	}
}
function maj_reponse_quiz(context, data)
{
	if(context == "ajout_reponse")
	{
		
		$.each(reponse_quiz.questions, function(indice_question, question) 
		{
			if(question.numero_question == data.numero_question)
			{
				question.reponses.push(data.reponse);
				question.reponses = data.reponse;
			}
		});
	}
	if(context == "modif_reponse")
	{
		
		$.each(reponse_quiz.questions, function(indice_question, question) 
		{
			if(question.numero_question == data.numero_question)
			{
				$.each(question.reponses, function(indice_reponse, reponse) 
				{
					if(reponse.numero_reponse == data.reponse.numero_reponse)
					{
						reponse.splice(data.reponse.numero_reponse, 1, data.reponse);
						// reponse.push(data.reponse);
						// question.reponses = data.reponse;
					}
				});
				question.reponses.push(data.reponse);
				question.reponses = data.reponse;
			}
		});
	}
}

function send_new_question()
{
	question_courante = $("#quiz_numero_question").find(":selected").val();
	reponse_multiple = $("#reponse_muliple").is(":checked");
	id_quiz = $("#quiz_div").attr("value");
	text_question = $("#quiz_text_area").val();
	duree_question = $("#temps_reponse").val()*1000;
	if(text_question == "")
	{
		alert("Vous devez ecrire une question avant de l'ajouter.\n"+text_question);
		return;
	}
	// var ask = window.confirm("Souhaitez-vous vraiment créer un nouveau quiz ?");
	ask = true;
	if (ask)
	{
		var parameters = 
		{

			question_courante : question_courante,
			id_quiz : id_quiz,
			multi : reponse_multiple,
			text : text_question,
			temps_reponse : duree_question,
			
			requete : 'new_question'
        }
        $.ajax(
		{
            url: '/ajax.php?page=services/requete_quiz.php',
            type: 'post',
            dataType: 'json',
            success: function (data) 
			{
				if(data != 'nok')
				{
					$("#quiz_text_area").html("");
					 $("#bouton_quiz_reponse").attr("display", "disable");
					 alert(data);
				}
				else
				{
					 $("#resultat").html("<p>Erreur lors de la connexion...</p>");
				}
            },
            data: parameters
        });
	}
}
function send_reponse_fin()
{
	if(send_new_reponse())
	{
		if($("#quiz_numero_question").find(":selected").val() < $("#quiz_numero_question").find(":last").val())
		{
			$("#quiz_numero_question[value='" + ($("#quiz_numero_question").find(":selected").val() + 1) + "']").attr('selected', true);
			$("#quiz_numero_reponse[value='" + 1 + "']").attr('selected', true);
		}
	}
}
function send_new_reponse()
{
	reponse_courante = $("#quiz_numero_reponse").find(":selected").val();
	bonne_reponse = $("#reponse_juste:checked").val() ==  "on";
	id_question = $("#quiz_numero_question").find(":selected").val(); 
	id_quiz = $("#quiz_div").attr("value");
	text_reponse = $("#quiz_text_area").val();
	// duree_question = $("#temps_reponse").val()*1000;
	if(text_reponse == "")
	{
		alert("Vous devez ecrire une réponse avant de l'ajouter.\n"+text_reponse);
		return;
	}
	// var ask = window.confirm("Souhaitez-vous vraiment créer un nouveau quiz ?");
	ask = true;
	if (ask)
	{
		
		var parameters = 
		{
			reponse_courante : reponse_courante,
			id_question : id_question,
			id_quiz : id_quiz,
			bonne_reponse : bonne_reponse,
			text : text_reponse,
			
			requete : 'new_reponse'
        }
        $.ajax(
		{
            url: '/ajax.php?page=services/requete_quiz.php',
            type: 'post',
            dataType: 'json',
            success: function (data) 
			{
				if(data != 'nok')
				{
					$("#quiz_text_area").html("");
					// $("#bouton_quiz_reponse").attr("display", "");
					alert(data);
					maj_reponse_quiz(data);
					increment_form_reponse();
					// $("#quiz_numero_reponse[value='" + 1 + "']").attr('selected', true);
					return data;
				}
				else
				{
					 $("#resultat").html("<p>Erreur lors de la connexion...</p>");
				}
            },
            data: parameters
        });
	}
}
function increment_form_reponse()
{
	last_option = parseInt($("#quiz_numero_reponse:last").val()) + 1;
	balise_option = '<option value="'+ last_option +'" class="">'+ last_option +'</option>';
	$("#quiz_numero_reponse").append(balise_option);
	$("#quiz_numero_reponse:last").attr('selected', true);
}
function send_reponse()
{
	
	nb_question = $("#quiz_numero_question").find(":last").val();
	question_courante = $("#quiz_numero_question").find(":selected").val();
	nb_reponse = $("#quiz_numero_reponse").find(":last").val();
	reponse_courante = $("#quiz_numero_reponse").find(":selected").val();
	reponse_juste = $("#reponse_juste:checked").val() == "on";
	// id_quiz = $("#quiz_div").value();
	
	// alert("nb_question : " + nb_question + " question_courante : " + question_courante + " nb_reponse : " + nb_reponse + " reponse_courante : " + reponse_courante + " reponse_juste : " + reponse_juste);
	
	/*
	nb_question = $("#quiz_nb_question").find(":selected").val();
	question_courante = $("#quiz_numero_question").find(":selected").val();
	nb_reponse = $("#quiz_nb_reponse").find(":selected").val();
	reponse_courante = $("#quiz_numero_reponse").find(":selected").val();
	$("#quiz_numero_question"),
	titre = $("#quiz_titre").val();
	
	var ask = window.confirm("Souhaitez-vous vraiment créer un nouveau quiz ?");
	if (ask)
	{
		var parameters = 
		{
			nb_question : nb_question,
			question_courante : question_courante,
			nb_reponse : nb_reponse,
			reponse_courante : reponse_courante,
			
			requete : 'get_quiz'
        }
        $.ajax(
		{
            url: '/ajax.php?page=services/requete_quiz.php',
            type: 'post',
            dataType: 'json',
            success: function (data) 
			{
				if(data != 'ko')
				{
					alert(data);
					// response = JSON.parse(data);
					// Le membre est connecté. Ajoutons lui un message dans la page HTML.
					// $("#com_"+id_comment).remove();
					// alert(data);
					$("#debug").html(data["html"]);
				}
				else
				{
					 // Le membre n'a pas été connecté. (data vaut ici "failed")
					 $("#resultat").html("<p>Erreur lors de la connexion...</p>");
				}
            },
            data: parameters
        });
	}*/
}

// prends un quiz au format json et l'affiche 
function print_quiz(new_quiz, numero_question)
{
	quiz = new_quiz;
	item = '';
	html = '';
	html = '<div>' + quiz.titre;
	bouton = '';
	$.each(quiz.questions, function(indice_question, question) 
	{
		if(question.numero_question == numero_question)
		{
			html += '<div id="intitule_question">question n°' + numero_question + ' : ' + question.text + '</div>';
			html += '<div id="reponses">';
			
			if(question.multi == true)
			{
				type = 'checkbox';
			}
			else
			{
				type = 'radio';
			}
			$.each(question.reponses, function(indice_reponse, reponse) 
			{
				html += '<div>';
				html += '<input type="' + type + '" id="reponse_' + reponse.numero_reponse + '" name="reponse" value="' + reponse.id + '">';
				html += '<label for="reponse_' + reponse.numero_reponse + '">' + reponse.text + '</label>';
				html += '</div>';
			});
			html += '</div></div>';
			bouton = '<input type="button" onclick="send_reponse(' + reponse_quiz + ');return false;" class="bt_bouton fright" value="Terminer"/>'
		}
		else if(question.numero_question == numero_question + 1)
		{
			bouton = '<input type="button" onclick="print_quiz(quiz, ' + (question.numero_question) + ');return false;" class="bt_bouton fright" value="Valider"/>';
		}
	});
	html += bouton;
	html += '</div>';
	
	
	$("#quiz_app").html(html);
	
	function modif_question()
	{
		var parameters = {
			nb_question : nb_question,
			requete : 'modif_question',
        }
        $.ajax(
		{
            url: '/ajax.php?page=services/requete_quiz.php',
            type: 'post',
            dataType: 'json',
            success: function (data) 
			{
				if(data != 'ko')
				{
					// alert(data);
					// response = JSON.parse(data);
					// Le membre est connecté. Ajoutons lui un message dans la page HTML.
					// $("#com_"+id_comment).remove();
					// alert(data);
					$("#quiz_div").html(data["html"]);
					$("#quiz_div").attr("value",data["id_quiz"]);
				}
				else
				{
					// Le membre n'a pas été connecté. (data vaut ici "failed")
					$("#resultat").html("<p>Erreur lors de la connexion...</p>");
				}
            },
            data: parameters
        });
	}
}
// -------------------------------- Fin fonctions Quiz ------------------------------ //
