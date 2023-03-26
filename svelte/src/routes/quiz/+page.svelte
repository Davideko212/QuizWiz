<script lang="ts">
	import { Stepper, Step } from '@skeletonlabs/skeleton';
	import { modalStore } from '@skeletonlabs/skeleton';
	import type { ModalSettings, ModalComponent } from '@skeletonlabs/skeleton';
	import { questions } from '../../stores.js';

	let questionsValue: Array<Object>;
	questions.subscribe(value => {
		questionsValue = value;
	});

	let answers = {};
	questionsValue.forEach(question => answers[question.PK_FrageId] = -1);

	const modal: ModalSettings = {
		type: 'confirm',
		title: 'Quiz beenden',
		body: 'Wollen Sie das Quiz beenden und Ihre Antworten abschicken?',
		response: (r: boolean) => console.log('response:', r),
	};

	function onChange(PK_FrageId, FK_AntwortID) {
		answers[PK_FrageId] = FK_AntwortID;
	}

	function finishModal() {
		modalStore.trigger(modal);
	}
</script>

<main>
	<h1>QUIZ</h1>

	<div id="stepper">
		<Stepper on:complete={finishModal}>
			{#each questionsValue as q}
				<Step>
					<svelte:fragment slot="header">{q.Fragestellung}</svelte:fragment>
					{#each q[0] as answer}
						<div id="answer">
							<!-- i mean it works -->
							<input type="radio" name={q.PK_FrageId} checked={answers[q.PK_FrageId] === answer.FK_AntwortID} value={answer.FK_AntwortID} on:change={onChange(q.PK_FrageId, answer.FK_AntwortID)}>
							<label for={answer.FK_AntwortID}>{answer.Antwortmoeglichkeit}</label>
						</div>
					{/each}
				</Step>
			{/each}
		</Stepper>
	</div>
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
