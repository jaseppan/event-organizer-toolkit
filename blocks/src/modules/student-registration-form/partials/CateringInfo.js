const { Component } = wp.element;
const { Spinner } = wp.components;
 
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
                        { console.log(this.state.list.data) }
                        {this.state.list.data.map(item => (
                            <li key={item.id}>
                                Type: {item.type}, Price: {item.price}
                            </li>
                        ))}
                    </ul>
                    
                )}
			</div>
		);
 
	}
}
export default CateringInfo;