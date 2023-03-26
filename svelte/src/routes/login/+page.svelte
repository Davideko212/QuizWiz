<script lang="ts">
	let user: string;
	let password: string;
	let passwordConfirm: string;
	let register: boolean = false;;

	function login() {
		console.log("logging in");


	}

	function switchRegister() {
		register = !register;
	}
</script>

<main>
	<h1>LOGIN</h1>
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
