<script lang='ts'>
    import { modalStore, toastStore } from '@skeletonlabs/skeleton';
    import type { ModalSettings, ToastSettings } from '@skeletonlabs/skeleton';
    import { userID } from '../stores';
    import { onMount } from 'svelte';

    const endpoint = "http://localhost/QuizWiz/backend/userfetch.php";

    let date: string;
    let name: string;
    let count: number;
	let accuracy: number;
    onMount(async () => {
		const res = await fetch(endpoint, {
			method: 'POST',
			body: JSON.stringify({
				userIDValue
			})
		});

		const data = await res.json();

        date = data["Anmeldedatum"];
        name = data["Benutzername"];
        count = data["QuizCount"];
		accuracy = data["AccuracySum"] / 100;
	})

    let userIDValue: number;
	userID.subscribe(value => {
		userIDValue = value;
	});

    const toast: ToastSettings = {
		// maybe change this text later
		message: '👋 Erfolgreich Abgemeldet! 👋',
	};

    const modal: ModalSettings = {
		type: 'confirm',
		title: 'Abmelden',
		body: 'Möchten Sie sich wirklich abmelden?',
		response: (r: boolean) => {
			if (r) {
				userID.set(0);
				toastStore.trigger(toast);
			}
		}
	};

    function logoutModal() {
		modalStore.trigger(modal);
	}
</script>

<main>
	<h3>{name}</h3>
	<div id="text">
		<p>Registriert seit: {date}</p>
		<p>Anzahl bestandener Quizzes: {count}</p>
		{#if count != 0}
			<p>Durchschnittsgenauigkeit: {(accuracy/count).toFixed(2)}%</p>
		{/if}
	</div>
	<button type="button" class="btn btn-sm variant-ghost-surface" on:click={logoutModal}>Abmelden</button>
</main>

<style>
	main {
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
		gap: 10px;
	}
</style>