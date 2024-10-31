if( document.getElementById( 'mxLinkShortener' ) ) {

	// Form
	Vue.component( 'mx_link_shortener_form', {

		template: ` 
			<div>

				<form @submit.prevent="prepareShortLink" class="mx-link-shortener-form">

					<div>
						<label for="mxLinkShortenerLongLink">Fill in a Long link</label>
						<input 
							v-model="mxlinkshortenerlonglink"
							type="url"
							id="mxLinkShortenerLongLink" 
						/>
					</div>

					<div>
						<label for="mxLinkShortenerEmailAddress">Fill in your email address</label>
						<input 
							v-model="mxlinkshorteneremailaddress"
							type="email"
							id="mxLinkShortenerEmailAddress" 
						/>
					</div>

					<div class="mx_agreement_wrapper">

						<div>
							<input 
								v-model="mxlinkshorteneremailagreement"
								type="checkbox"
								id="mxLinkShortenerEmailAgreement" 
							/>
						</div>
						<div>

							<label for="mxLinkShortenerEmailAgreement">I agree that my e-mail address will be stored in this service and will not be shared with third-party services.</label>

						</div>
						
					</div>

					<div
						v-if="errors.length > 0"
						class="mx-link-shortener-form-errors"
					>
						<ul>
							<li
								v-for="error in errors"
							>{{ error }}</li>
						</ul>
					</div>

					<div
						v-if="success"
						class="mx-link-shortener-form-success"
					>
						We've sent the link to your email address.
					</div>

					<div
						v-if="!success"
					>
						<button class="mx-link-shortener-form-button">Create a short link!</button>
					</div>

				</form>
			</div>
		`,
		data() {

			return {
				mxlinkshortenerlonglink: 		null,
				mxlinkshorteneremailaddress: 	null,
				mxlinkshorteneremailagreement: 	false,
				errors: [],
				success: false
			}

		},
		methods: {

			prepareShortLink() {

				console.log( this.mxlinkshorteneremailagreement )

				this.errors = []

				if( this.mxlinkshortenerlonglink && this.mxlinkshorteneremailaddress && this.mxlinkshorteneremailagreement ) {

					// send a request
					this.createShortLink()

				} else {

					this.errors.push( 'All the fields are required!' )

					if( ! this.mxlinkshortenerlonglink ) {

						this.errors.push( 'Fill in a link!' )

					}
					
					if( ! this.mxlinkshorteneremailaddress ) {

						this.errors.push( 'Fill in your email!' )

					}

					if( ! this.mxlinkshorteneremailagreement ) {

						this.errors.push( 'Tick out the agreement!' )

					}					

				}

			},

			createShortLink() {

				const _this = this

				const ajaxurl = mxmls_local_obj.ajaxurl
				const nonce = mxmls_local_obj.nonce

				const data = {
					action: 'mx_create_short_link',
					nonce: nonce,
					long_link: this.mxlinkshortenerlonglink,
					email: this.mxlinkshorteneremailaddress
				}

				jQuery.post( ajaxurl, data, function( response ) {

					if( response === '1' ) {

						_this.mxlinkshortenerlonglink = null
						_this.mxlinkshorteneremailaddress = null

						_this.success = true

					} else {

						_this.errors.push( 'Something went wrong. Please, try later!' )

					}

				} )

			}

		}

	} )
	
	// 
	let app = new Vue( {
		el: '#mxLinkShortener',
		data: {

		},
		methods: {

		}
	} )

}

if( document.getElementById( 'mxLinkShortenerUpdate' ) ) {

	Vue.component( 'mx_link_shortener_notification', {
		props: {
			error: {
				type: Boolean
			}
		},
		template: `
		 <div
			v-if="error"
			class="mx-link-shortener-form-error"
		>
			Something went wrong!
		</div>
		`
	} )

	let app = new Vue( {
		el: '#mxLinkShortenerUpdate',
		data: {
			short_link_hash: null,
			long_link: null,
			error: false
		},
		methods: {

			prepareUpdate() {

				if( typeof window.mx_long_link !== 'undefined' ) {

					this.long_link = mx_long_link

				}

				if( typeof window.mx_url_hash !== 'undefined' ) {

					this.short_link_hash = mx_url_hash

				}				

			},

			updateLink() {

				if( ! this.short_link_hash )
					return

				if( ! this.long_link )
					return

				const _this = this

				const ajaxurl = mxmls_local_obj.ajaxurl
				const nonce = mxmls_local_obj.nonce

				const data = {
					action: 'mx_update_short_link',
					nonce: nonce,
					short_link_hash: _this.short_link_hash
				}

				jQuery.post( ajaxurl, data, function( response ) {

					if( response === '1' ) {

						let long_link = _this.long_link.replace( /&#038;/g, '&' )

						window.location.href = long_link

					} else {

						_this.error = true

					}

				} )

			}

		},
		mounted() {

			this.prepareUpdate()

			this.updateLink()

		}
	} )

}