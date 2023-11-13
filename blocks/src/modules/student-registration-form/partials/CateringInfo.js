const { Component } = wp.element;
const { Spinner } = wp.components;
import { __ } from '@wordpress/i18n';
 
class CateringInfo extends Component {
	constructor(props) {
		super(props);
		this.state = {
			list: [],
			loading: true
		}
	}
 
	componentDidMount() {
		this.runApiFetch();
	}
 
	runApiFetch() {
		wp.apiFetch({
			path: 'event-organizer-toolkit/v1/list-meal-types',
		}).then(data => {
            
			this.setState({
				list: data.data,
				loading: false
			});
		});
	}
 
	render() {
		return(
			<div>      
				{ this.state.loading ? (
					<Spinner />
                ) : (
					<ul>
                        {this.state.list.data.map(item => (
                            <li key={item.id}>
                                { __( item.type, 'event-organizer-toolkit' ) }: {item.price} {/* Normally esc_html__ would be used here but in Gutenberg we need to use __ */}
                            </li>
                        ))}
                    </ul>
                    
                )}
			</div>
		); 
	}
}

export default CateringInfo;