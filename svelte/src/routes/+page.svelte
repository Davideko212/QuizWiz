<script lang="ts">
    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";
	import { modalStore, toastStore } from '@skeletonlabs/skeleton';
	import type { ToastSettings } from '@skeletonlabs/skeleton';
	import { questions, lightmode, answers } from '../stores.js';
    import { construct_svelte_component } from "svelte/internal";

	const endpoint = "http://localhost/QuizWiz/backend/questions.php";
	let categoriesSelected: Array<string> = [];
	let amount = 5;
	let diff = 5;
	let target = "/";
	let data;

	let questionsValue;
	questions.subscribe(value => {
		questionsValue = value;
	})

	const toast: ToastSettings = {
		// maybe change this text later
		message: '⚠️ Wählen Sie eine Kategorie aus! ⚠️',
	};

	const startModal: ModalSettings = {
		type: 'confirm',
		title: 'Quiz starten',
		body: 'Möchten Sie das Quiz wirklich starten?',
		response: (r: boolean) => {
			if (r) {
				while (questionsValue.length != amount) {
					let temp = randomProperty(data);
					console.log(temp);
					questionsValue.push(temp);
					data.pop(temp);
				}

				questions.set(questionsValue);

				window.location.href = "/quiz";
			}
		}
	};

	const deleteModal: ModalSettings = {
		type: 'confirm',
		title: 'Quiz abbrechen',
		body: 'Möchten Sie wirklich das derzeit aktive Quiz abbrechen?',
		response: (r: boolean) => {
			if (r) {
				questions.set([]);
				answers.set({});
			}
		}
	};

	async function fetchQuestions() {
		questions.set([]);

		const res = await fetch(endpoint, {
			method: 'POST',
			body: JSON.stringify({
				categoriesSelected,
				amount,
				diff
			})
		});

		data = await res.json();

		if (data.length === 0) {
			// If the quiz criteria result in finding no questions, show an error message
			toastStore.trigger(toast);
		} else if (data.length < amount) {
			// tell the user that the chosen amount could not be fulfilled
			// TODO
			//$questions = data;
		}
	}

	function randomProperty(obj: Object) {
		let keys = Object.keys(obj);
		return obj[keys[ keys.length * Math.random() << 0]];
	}

	function quiz() {
		fetchQuestions();
		modalStore.trigger(startModal);
	}

	function deleteQuiz() {
		modalStore.trigger(deleteModal);
	}
</script>

<main>
	{#if $lightmode}
		<img src="/QuizWiz.png">
	{:else}
		<img src="/QuizWiz_dark.png">
	{/if}
	{#if questionsValue.length > 0}
		<h3>Es wurde ein bereits aktives Quiz auf Ihrem Gerät festgestellt:</h3>
		<a class="btn variant-filled" href="/quiz">
			Zurück zum Quiz
		</a>
		<a class="btn variant-filled" on:click={deleteQuiz}>
			Quiz abbrechen
		</a>
	{:else}
		<CategorySelect bind:categoriesSelected={categoriesSelected}/>
		<QuestionSelect bind:amount={amount} bind:diff={diff}/>
		<a class="btn variant-filled" on:click={quiz}>
			Quiz starten
		</a>
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

	img {
		width: 40%;
	}
</style>
