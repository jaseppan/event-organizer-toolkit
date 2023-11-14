const { Component } = wp.element;
const { Spinner } = wp.components;
import { __ } from '@wordpress/i18n';
 
class CateringCheckboxes extends Component {
	constructor(props) {
		super(props);
		this.state = {
			list: [],
			loading: true,
            selectAll: false,
            selectedMeals: []
		}
	}
 
	componentDidMount() {
		this.runApiFetch();
	}
 
	runApiFetch() {
		wp.apiFetch({
			path: 'event-organizer-toolkit/v1/list-meals?order=asc&order_by[]=date&order_by[]=start_time',
		}).then(data => {
			this.setState({
				list: data.data,
				loading: false
			});
		});
	}

    handleSelectAllChange = (event) => {
        const { checked } = event.target;
        const { list, selectedMeals } = this.state;
        let updatedSelectedMeals;
        
        if (checked) {
            updatedSelectedMeals = list.data.map(item => item.id);
        } else {
            updatedSelectedMeals = [];
        }
        
        this.setState({ selectAll: checked, selectedMeals: updatedSelectedMeals });
    };

    handleMealChange = (event) => {
        const { value } = event.target;
        this.setState(prevState => {
            const selectedMeals = [...prevState.selectedMeals];
            const index = selectedMeals.indexOf(value);
            if (index > -1) {
                selectedMeals.splice(index, 1);
            } else {
                selectedMeals.push(value);
            }
            return { selectedMeals };
        });
    };

	render() {
		return(
			<div>      
				{ this.state.loading ? (
					<Spinner />
                ) : (
                    <div>
                        {/* Select all checkbox to select all meals (class .meal) */}
                        <div class="eot-select-all-container">
                            <input
                                type="checkbox"
                                name="select-all"
                                className="select-all"
                                checked={this.state.selectAll} // Add checked attribute
                                onChange={this.handleSelectAllChange} // Add onChange event handler
                            />
                            <label>{__('Select All')}</label>
                        </div>
                        
                        {this.state.list.data.map(item => (
                            <div key={item.id}>
                                <input
                                    type="checkbox"
                                    name="meal"
                                    className="meal"
                                    value={item.id}
                                    checked={this.state.selectedMeals.includes(item.id)} // Add checked attribute
                                    onChange={this.handleMealChange} // Add onChange event handler
                                />
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