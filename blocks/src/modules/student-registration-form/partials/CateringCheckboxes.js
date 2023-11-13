const { Component } = wp.element;
const { Spinner } = wp.components;
import { __ } from '@wordpress/i18n';
 
class CateringCheckboxes extends Component {
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
			path: 'event-organizer-toolkit/v1/list-meals',
		}).then(data => {
            console.log(data.data);
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
					<div>
                        {this.state.list.data.map(item => (
                            <div key={item.id}>
                                <input type="checkbox" name="meal" value={item.id} />
                                <label>
                                    {item.title} {new Date(item.date).toLocaleDateString()}
                                </label>
                            </div>
                               
                        ))}
                    </div>
                    
                )}
			</div>
		); 
	}
}

export default CateringCheckboxes;