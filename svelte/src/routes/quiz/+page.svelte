<script lang="ts">
	import { onMount } from 'svelte';
	import { Stepper, modalStore, type ModalSettings } from '@skeletonlabs/skeleton';
	import { questions, answers } from '../../stores';
	import QuestionStep from "../../components/QuestionStep.svelte";

	$questions.forEach(question => {
		if ($answers[question.PK_FrageId] == undefined) {
			$answers[question.PK_FrageId] = -1;
		}
	});

	const endpoint = "http://localhost/QuizWiz/backend/reload.php";

	const modal: ModalSettings = {
		type: 'confirm',
		title: 'Quiz beenden',
		body: 'Wollen Sie das Quiz beenden und Ihre Antworten abschicken?',
		response: async(r: boolean) => {
			if (r) {	
				await fetch(endpoint, {
					method: 'GET'
				});

				window.location.href = "./quiz/score.html";
			}
		},
	};

	function finishModal() {
		modalStore.trigger(modal);
	}

	onMount(async () => {
		console.log("meow");
	})
</script>

<main>
	<h1>QUIZ</h1>

		{#if $questions.length === 0}
			<h2>Es konnte kein aktives Quiz gefunden werden.</h2>
			<a class="btn variant-filled" href="./">
				Zurück zum Hauptmenü
			</a>
		{:else}
			<div id="stepper">
				<Stepper on:complete={finishModal} buttonBackLabel="← Zurück" buttonNextLabel="Nächste →" buttonCompleteLabel="Auswerten" stepTerm="Frage">
					{#each $questions as q}
						<QuestionStep question={q} />
					{/each}
				</Stepper>
			</div>
		{/if}
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
		gap: 15px;
	}

	#stepper {
		margin-left: 20%;
		margin-right: 20%;
		min-width: 60%;
	}
</style>
