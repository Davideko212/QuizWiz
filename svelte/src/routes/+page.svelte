<script lang="ts">
    import CategorySelect from "../components/CategorySelect.svelte";
    import QuestionSelect from "../components/QuestionSelect.svelte";
	import { modalStore, toastStore } from '@skeletonlabs/skeleton';
	import type { ToastSettings, ModalSettings } from '@skeletonlabs/skeleton';
	import { questions, lightmode, answers } from '../stores';

	const endpoint = "http://localhost/QuizWiz/backend/questions.php";
	let categoriesSelected: Array<string> = [];
	let amount = 5;
	let diff = 5;
	let data: Array<Object>;

	let questionsValue: Array<Object>;
	questions.subscribe(value => {
		questionsValue = value;
	})

	const toast: ToastSettings = {
		message: '⚠️ Wählen Sie eine Kategorie aus! ⚠️',
	};

	const startModal: ModalSettings = {
		type: 'confirm',
		title: 'Quiz starten',
		body: 'Möchten Sie das Quiz wirklich starten?',
		response: (r: boolean) => {
			if (r) {
				while (questionsValue.length != amount) {
					let index = data.length * Math.random();
					questionsValue.push(data.splice(index, 1)[0]);
				}

				questions.set(questionsValue);

				window.location.href = "http://localhost/QuizWiz/svelte/build/quiz.html";
			}
		}
	};

	const partialModal: ModalSettings = {
		type: 'alert',
		title: 'Achtung',
		body: " ACHTUNG: ".bold() +
				"Es konnte nicht die gewünschte Anzahl an Fragen gefunden werden, ihre Quiz-Parameter sind wahrscheinlich zu spezifisch. "
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
			let orig = partialModal.body;
			partialModal.body += (data.length + "/" + amount + " Fragen gefunden.").bold();
			modalStore.trigger(partialModal);
			setTimeout(function(){
				partialModal.body = orig;
			}, 100); 
		} else {
			modalStore.trigger(startModal);
		}
	}

	function deleteQuiz() {
		modalStore.trigger(deleteModal);
	}
</script>

<main>
		{#if $lightmode}
			<img src="http://localhost/QuizWiz/svelte/build/QuizWiz.png">
		{:else}
			<img src="http://localhost/QuizWiz/svelte/build/QuizWiz_dark.png">
		{/if}
		{#if questionsValue.length > 0}
			<h3>Es wurde ein bereits aktives Quiz auf Ihrem Gerät festgestellt:</h3>
			<a class="btn variant-filled" href="http://localhost/QuizWiz/svelte/build/quiz.html">
				Zurück zum Quiz
			</a>
			<button class="btn variant-filled" on:click={deleteQuiz}>
				Quiz abbrechen
			</button>
		{:else}
			<CategorySelect bind:categoriesSelected={categoriesSelected}/>
			<QuestionSelect bind:amount={amount} bind:diff={diff}/>
			<button class="btn variant-filled" on:click={fetchQuestions}>
				Quiz starten
			</button>
		{/if}
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
		position: absolute;
		top: 50%;
		left: 50%;
		-ms-transform: translate(-50%, -50%);
		transform: translate(-50%, -50%);
	}

	img {
		width: 60%;
	}
</style>
