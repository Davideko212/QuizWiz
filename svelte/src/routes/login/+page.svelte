<script lang="ts">
	import { toastStore } from '@skeletonlabs/skeleton';
	import type { ToastSettings } from '@skeletonlabs/skeleton';
	import { userID } from '../../stores';

	let user: string;
	let password: string;
	let passwordConfirm: string;
	let register: boolean = false;
	let date: string = new Date().toISOString().slice(0, 10).replace('T', ' ');
	const loginEndpoint = "http://localhost/QuizWiz/backend/login.php";
	const registerEndpoint = "http://localhost/QuizWiz/backend/register.php";

	const toast: ToastSettings = {
		message: "",
	};

	async function login() {
		let endpoint;
		if (register) {
			endpoint = registerEndpoint;

			if (!(password === passwordConfirm)) {
				toast.message = "⚠️ Die angegebenen Passwörter stimmen nicht überein! ⚠️";
				toastStore.trigger(toast);
				return;
			}
		} else {
			endpoint = loginEndpoint;
		}

		const res = await fetch(endpoint, {
			method: 'POST',
			body: JSON.stringify({
				user,
				password,
				date
			})
		});

		const data = await res.json();
		if (!register) {

			if (data > 0) {
				// user found, correct pw
				toast.message = "✔️ Erfolgreich eingeloggt! ✔️";
				userID.set(data);
			} else if (data === 0) {
				// user not found
				toast.message = "⚠️ Benutzer gibt es nicht! Haben Sie sich schon registriert? ⚠️";
			} else {
				// user found, incorrect pw
				toast.message = "⚠️ Falsches Passwort! ⚠️";
			}
		} else {
			if (data < 0) {
				toast.message = "⚠️ Registrierung fehlgeschlagen, Benutzername ist bereits vergeben! ⚠️";
			} else {
				toast.message = "✔️ Erfolgreich registriert! ✔️";
			}
		}

		toastStore.trigger(toast);
	}

	function switchRegister() {
		register = !register;
	}
</script>

<main>
	{#if register}
		<h1>REGISTER</h1>
	{:else}
		<h1>LOGIN</h1>
	{/if}
	<div id="input">
		<label for="user">Benutzername:</label>
		<input type="text" id="user" placeholder="Benutzername" bind:value={user} />
		<label for="password">Passwort:</label>
		<input type="password" id="password" placeholder="Passwort" bind:value={password} />
		{#if register}
			<label for="passwordConfirm">Passwort bestätigen:</label>
			<input type="password" id="passwordConfirm" placeholder="Passwort bestätigen" bind:value={passwordConfirm} />
		{/if}
		<button class="btn variant-filled-primary" on:click={login}>Submit</button>
	</div>
	<div id="info">
		<button class="btn variant-filled-primary" on:click={switchRegister}>Registrieren</button>
	</div>
</main>

<style>
	main {
		display: flex;
		flex-direction: column;
		padding: 1em;
		margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
		gap: 20px;
	}

	#input {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}
</style>
