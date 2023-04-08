<script lang="ts">
	import { Stepper, Step } from '@skeletonlabs/skeleton';
	import { modalStore } from '@skeletonlabs/skeleton';
	import type { ModalSettings, ModalComponent } from '@skeletonlabs/skeleton';
	import { questions, answers, userID } from '../../stores.js';
	import { onMount } from 'svelte';

	$: console.log($answers);
	console.log("meow");
	$: console.log($questions);
	$questions.forEach(question => {
		if ($answers[question.PK_FrageId] == undefined) {
			$answers[question.PK_FrageId] = -1;
		}
	});

	const endpoint = "http://localhost/QuizWiz/backend/quizcount.php";
	let userIDValue;
	userID.subscribe(value => {
		userIDValue = value;
	})

	const modal: ModalSettings = {
		type: 'confirm',
		title: 'Quiz beenden',
		body: 'Wollen Sie das Quiz beenden und Ihre Antworten abschicken?',
		response: async(r: boolean) => {
			if (r) {
				if (userIDValue != 0) {
					await fetch(endpoint, {
						method: 'POST',
						body: JSON.stringify({
							userIDValue
						})
					});
				}
				
				window.location.href = "./quiz/score.html";
			}
		},
	};

	function onChange(PK_FrageId, FK_AntwortID) {
		$answers[PK_FrageId] = FK_AntwortID;
	}

	function getType(q) {
		let type = q.Antworttyp;

		switch (type) {
			case 0:
				return "radio";
			case 1:
				return "checkbox";
		}
	}

	function finishModal() {
		modalStore.trigger(modal);
	}
</script>

<main>
	<h1>QUIZ</h1>

	{#if $questions.length == 0}
		<h2>Es konnte kein aktives Quiz gefunden werden.</h2>
	{:else}
		<div id="stepper">
			<Stepper on:complete={finishModal}>
				{#each $questions as q}
					<Step>
						<svelte:fragment slot="header">{q.Fragestellung}</svelte:fragment>
						{#each q[0] as answer}
							<div id="answer">
								<!-- i mean it works -->
								<input
									type={getType(q)}
									name={q.PK_FrageId} checked={$answers[q.PK_FrageId] === answer.FK_AntwortID} value={answer.FK_AntwortID} id={answer.FK_AntwortID} 
									on:change={onChange(q.PK_FrageId, answer.FK_AntwortID)}
								>
								<label for={answer.FK_AntwortID}>{answer.Antwortmoeglichkeit}</label>
							</div>
						{/each}
					</Step>
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
	}

	#stepper {
		min-width: 60%;
	}

	#answer {
		display: flex;
		flex-direction: row;
		gap: 10px;
	}
</style>
